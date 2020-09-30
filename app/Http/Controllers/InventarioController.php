<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Contas;
use App\Models\Planos;
use App\Models\Gestores;
use App\Models\TiposLinha;
use App\Models\Status;
use App\Models\Setores;
use App\Models\Subsetores;
use App\Models\Filiais;
use App\Models\Funcoes;
use App\Models\Grupos;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\LogSistema;
use Illuminate\Support\Facades\Crypt;

class InventarioController extends Controller
{
    private $inventario;


    public function __construct(inventario $inventario)
    {
        $this->inventario = $inventario;
        $this->middleware('auth');
        $this->middleware('check.permissions')->except([
                          'index',
                          'edit',
                          'update',
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inventario $inventario)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        
        $linhas = DB::table('inventarios')->orderBy('nome_usuario','ASC')
        ->select(array('inventarios.observacao as obsInventario', 'inventarios.id as idInventario','inventarios.*','contas.*','planos.*','gestores.*',
                       'setores.*','subsetores.*','status.*','tipos_linhas.*','ultimos_usuarios.*','funcoes.*','filiais.*',
                        'grupos_users.*','grupos.*','operadoras.*'))
        ->join('planos', 'planos.id', '=', 'inventarios.plano_id')
        ->join('gestores', 'gestores.id', '=', 'inventarios.gestor_id')
        ->join('setores', 'setores.id', '=', 'inventarios.setor_id')
        ->join('subsetores', 'subsetores.id', '=', 'inventarios.subsetor_id')
        ->join('status', 'status.id', '=', 'inventarios.status_id')
        ->join('tipos_linhas', 'tipos_linhas.id', '=', 'inventarios.tipo_linha_id')
        ->join('ultimos_usuarios', 'ultimos_usuarios.linha', '=', 'inventarios.linha')
        ->join('funcoes', 'funcoes.id', '=', 'inventarios.funcao_id')
        ->join('filiais', 'filiais.id', '=', 'inventarios.filial_id')
        ->join('contas', 'contas.id', '=', 'inventarios.conta_id')
        ->join('operadoras', 'operadoras.id', '=', 'contas.operadora_id')
        ->join('grupos', 'grupos.id', '=', 'inventarios.grupo_id')
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'inventarios.grupo_id')
        ->where('users_id', $user_id)
        ->get();


        return view('inventario.index',compact('linhas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $contas = DB::table('contas')->orderBy('conta', 'ASC')
            ->select(array('contas.id AS contaID','contas.*', 'grupos.*', 'grupos_users.*', 'operadoras.*'))
            ->join('operadoras', 'operadoras.id', '=', 'contas.operadora_id')
            ->join('grupos', 'grupos.id', '=', 'contas.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'contas.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $funcoes = DB::table('funcoes')
            ->select(array('funcoes.id as funcaoID', 'funcoes.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'funcoes.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $gestores = DB::table('gestores')->orderBy('gestor', 'ASC')
            ->select(array('gestores.id AS gestorID','gestores.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'gestores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $filiais = DB::table('filiais')->orderBy('filial', 'ASC')
            ->select(array('filiais.id AS filialID','filiais.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'filiais.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $setores = DB::table('setores')->orderBy('setor', 'ASC')
            ->select(array('setores.id AS setorID','setores.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'setores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $subsetores = DB::table('subsetores')->orderBy('subsetor', 'ASC')
            ->select(array('subsetores.id AS subsetorID','subsetores.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'subsetores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id AS grupoID','grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        $planos = DB::table('planos')->orderBy('plano', 'ASC')
            ->select(array('planos.id AS PlanoID', 'operadoras.id AS OperadoraID', 'operadoras.*', 'planos.*', 'grupos_users.*'))
            ->join('operadoras', 'operadoras.id', '=', 'planos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'planos.grupo_id')
            ->where('users_id', $user_id)
            ->get();


        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $status = Status::all(['id', 'status'])->sortBy('status');
        return view('inventario.create',
               compact('contas','planos','gestores','tipos_linha','status','setores','subsetores','filiais','funcoes','grupos')); 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->except('_token');
        $insert = $this->inventario->insert($dataForm);

        if ($insert)
        {
            $user_id = Auth::id();
            #Obtendo o ultimo registro inserido.
            $registro_id = DB::getPDO()->lastInsertId();

            event(new LogSistema(
                $user_id,
                "Create",
                "Foi cadastrada a linha $request->linha.",
                "inventarios",
                $registro_id,
                $request->grupo_id,
                "1"
            ));

            return redirect()->route('inventario.index')->with('success', "A linha {$request->linha} foi cadastrada com sucesso!");
        }
            else
        {
            $user = Auth::user();
            $user_id = Auth::id();

            event(new LogSistema(
                $user_id,
                "Create",
                "Houve um erro ao tentar cadastrar a linha $request->linha.",
                "inventarios",
                NULL,
                $request->grupo_id,
                "0"
            ));
            return redirect()->route('inventario.create')->with('error', "Houve um erro ao cadastrar a linha {$request->linha}.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $id = Crypt::decrypt($id);

        $contas = DB::table('contas')->orderBy('conta', 'ASC')
            ->select(array('contas.id AS contaID','contas.*', 'grupos.*','grupos_users.*','operadoras.*'))
            ->join('operadoras', 'operadoras.id', '=', 'contas.operadora_id')
            ->join('grupos', 'grupos.id', '=', 'contas.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'contas.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $funcoes = DB::table('funcoes')->orderBy('funcao', 'ASC')
            ->select(array('funcoes.id AS funcaoID','funcoes.*', 'grupos.*', 'grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'funcoes.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        $gestores = DB::table('gestores')->orderBy('gestor', 'ASC')
            ->select(array('gestores.id AS gestorID','gestores.*', 'grupos.*', 'grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'gestores.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'gestores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $filiais = DB::table('filiais')->orderBy('filial', 'ASC')
            ->select(array('filiais.id AS filialID','filiais.*', 'grupos.*','grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'filiais.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'filiais.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $setores = DB::table('setores')->orderBy('setor', 'ASC')
            ->select(array('setores.id AS setorID','setores.*', 'grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'setores.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'setores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $subsetores = DB::table('subsetores')->orderBy('subsetor', 'ASC')
            ->select(array('subsetores.id AS subsetorID','subsetores.*', 'grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'subsetores.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'subsetores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id AS grupoID','grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();


        $planos = DB::table('planos')->orderBy('plano', 'ASC')
            ->select(array('planos.id AS PlanoID', 'operadoras.id AS OperadoraID', 'operadoras.*', 'planos.*', 'grupos_users.*'))
            ->join('operadoras', 'operadoras.id', '=', 'planos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'planos.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $status = Status::all(['id', 'status'])->sortBy('status');

        $inventario = $this->inventario->find($id);
        return view('inventario.edit',
               compact('contas', 'planos', 'gestores', 'tipos_linha', 
                       'status', 'setores', 'subsetores','inventario','filiais','funcoes','grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::id();

        $data = $request->all();
        $inventario  = $this->inventario->find($id);
        $inventario_old  = $this->inventario->find($id);

        # Dados antigos
        $filiais = DB::table('filiais')->find($request->filial_id);
        $funcoes = DB::table('funcoes')->find($request->funcao_id);
        $contas = DB::table('contas')->find($request->conta_id);
        $setores = DB::table('setores')->find($request->setor_id);
        $subsetores = DB::table('subsetores')->find($request->subsetor_id);
        $gestores = DB::table('gestores')->find($request->gestor_id);
        $planos = DB::table('planos')->find($request->plano_id);
        $status = DB::table('status')->find($request->status_id);
        $tiposlinhas = DB::table('tipos_linhas')->find($request->tipo_linha_id);
        $grupos = DB::table('grupos')->find($request->grupo_id);
        #

        $update   = $inventario->update($data);

        #REGISTRO DE LOGS
        if ($update)
        {
            //Nome do Usuário
            if ($inventario->nome_usuario != $inventario_old->nome_usuario) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O usuario foi alterado para $inventario->nome_usuario ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }
            
            //Numero do Chip
            if ($inventario->chip != $inventario_old->chip) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O chip foi alterado para $inventario->chip ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }
            
            //Função
            if ($inventario->funcao_id != $inventario_old->funcao_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "A função foi alterada para $funcoes->funcao ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Filial
            if ($inventario->filial_id != $inventario_old->filial_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "A filial foi alterada para $filiais->filial ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Conta
            if ($inventario->conta_id != $inventario_old->conta_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "A conta foi alterada para $contas->conta ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Setor
            if ($inventario->setor_id != $inventario_old->setor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O setor foi alterado para $setores->setor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Subsetor
            if ($inventario->subsetor_id != $inventario_old->subsetor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O subsetor foi alterado para $subsetores->subsetor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Gestor
            if ($inventario->gestor_id != $inventario_old->gestor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O gestor foi alterado para $gestores->gestor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Plano
            if ($inventario->plano_id != $inventario_old->plano_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O plano foi alterado para $planos->plano ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Status
            if ($inventario->status_id != $inventario_old->status_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O status foi alterado para $status->status ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Status
            if ($inventario->tipo_linha_id != $inventario_old->tipo_linha_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O tipo da linha foi alterado para $tiposlinhas->tipo ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Grupo
            if ($inventario->grupo_id != $inventario_old->grupo_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O grupo foi alterado para $grupos->grupo ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Reponsavel Despesa
            if ($inventario->resp_despesa != $inventario_old->resp_despesa) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "O responsável despesa foi alterado para $inventario->resp_despesa ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            //Observacão
            if ($inventario->observacao != $inventario_old->observacao) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "A observação foi alterada para $inventario->observacao ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "1"
                ));
            }

            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi atualizada com sucesso!");
        }
        else
        {
            //Nome do Usuário
            if ($inventario->nome_usuario != $inventario_old->nome_usuario) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o usuario da linha ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Numero do Chip
            if ($inventario->chip != $inventario_old->chip) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o número do chip ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Função
            if ($inventario->funcao_id != $inventario_old->funcao_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar a função ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Filial
            if ($inventario->filial_id != $inventario_old->filial_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar a filial ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Conta
            if ($inventario->conta_id != $inventario_old->conta_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar a conta ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Setor
            if ($inventario->setor_id != $inventario_old->setor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o setor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Subsetor
            if ($inventario->subsetor_id != $inventario_old->subsetor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o subsetor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Gestor
            if ($inventario->gestor_id != $inventario_old->gestor_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o gestor ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Plano
            if ($inventario->plano_id != $inventario_old->plano_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o plano ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Status
            if ($inventario->status_id != $inventario_old->status_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o status ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Status
            if ($inventario->tipo_linha_id != $inventario_old->tipo_linha_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o tipo da linha ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Grupo
            if ($inventario->grupo_id != $inventario_old->grupo_id) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o grupo ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Reponsavel Despesa
            if ($inventario->resp_despesa != $inventario_old->resp_despesa) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar o responsável da despesa ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            //Observacão
            if ($inventario->observacao != $inventario_old->observacao) {
                event(new LogSistema(
                    $user_id,
                    "Update",
                    "Houve um erro ao tentar atualizar a observação ($inventario->linha).",
                    "inventarios",
                    $inventario->id,
                    $inventario->grupo_id,
                    "0"
                ));
            }

            return redirect()->route('inventario.edit',  $id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = $this->inventario->find($id);
        $delete = $inventario->delete();

        $user_id = Auth::id();
        
        if ($delete) {
            event(new LogSistema(
                $user_id,
                "Delete",
                "Foi excluida a linha $inventario->linha.",
                "inventarios",
                $inventario->id,
                $inventario->grupo_id,
                "1"
            ));
            #file_put_contents(storage_path() . "/deletes.txt", $inventario);

            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi excluida com sucesso!");
        } 
        else
            return redirect()->route('inventario.show', $id);
    }
}
