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

class InventarioController extends Controller
{
    private $inventario;


    public function __construct(inventario $inventario)
    {
        $this->inventario = $inventario;
        $this->middleware('auth');
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
            return redirect()->route('inventario.index')->with('success', "A linha {$request->linha} foi cadastrada com sucesso!");
        else
            return redirect()->route('inventario.create')->with('error', "Houve um erro ao cadastrar a linha {$request->linha}.");
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
        $user = Auth::user();
        $user_id = Auth::id();

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
        $dataForm = $request->all();
        $inventario  = $this->inventario->find($id);
        $update   = $inventario->update($dataForm);

        if ($update)
            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi atualizada com sucesso!");
        else
            return redirect()->route('inventario.edit',  $id);
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

        if ($delete) {
            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi excluida com sucesso!");
        } else
            return redirect()->route('inventario.show', $id);
    }
}
