<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contas;
use App\Models\Operadoras;
use App\Models\Grupos;
use App\Models\Empresas;
use Illuminate\Support\Facades\Auth;
use App\Events\LogSistema;

class ContasController extends Controller
{

    public function __construct(Contas $contas)
    {
        $this->contas = $contas;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //usei para obter os dados do user e listar somente as contas do user logado.
        $user = Auth::user();
        $user_id = Auth::id();

        $contas = DB::table('contas')->orderBy('conta', 'asc')
            ->select(array('contas.id AS ContaID','contas.observacao AS obsConta', 'empresas.id AS EmpresaID', 'contas.*', 'empresas.*','grupos_users.*', 'grupos.*','operadoras.*'))
            ->join('operadoras', 'operadoras.id', '=', 'contas.operadora_id')
            ->join('empresas', 'empresas.id', '=', 'contas.empresa_id')
            ->join('grupos', 'grupos.id', '=', 'contas.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'contas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        return view('inventario.contas.index', compact('contas'));
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

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
        ->select(array('grupos.id AS GrupoID', 'grupos.*', 'grupos_users.*'))
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
        ->where('users_id', $user_id)
            ->get();

        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
        ->select(array('empresas.id AS EmpresasID', 'empresas.*', 'grupos_users.*'))
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
        ->where('users_id', $user_id)
            ->get();

        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
        ->select(array('operadoras.*'))
        ->where('tipo_operadora', '1')
            ->get();

        return view('inventario.contas.create', compact('operadoras', 'grupos', 'empresas'));

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $dataForm = $request->except('_token');
        $insert = $this->contas->insert($dataForm);

        if ($insert)
        {
            $registro_id = DB::getPDO()->lastInsertId();
            event(new LogSistema(
                $user_id,
                "Create",
                "A conta $request->conta foi caastrada.",
                "contas",
                $registro_id,
                $request->grupo_id,
                "1"
            ));     
            return redirect()->route('contas.index')->with('success', "A conta {$request->conta} foi cadastrada com sucesso!");
        }

        else
            return redirect()->route('contas.create')->with('error', "Houve um erro ao cadastrar a conta {$request->conta}.");
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

        $contas = Contas::all(['id', 'conta','operadora_id','observacao'])->sortBy('conta');
        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
            ->select(array('operadoras.*'))
            ->where('tipo_operadora', '1')
            ->get();

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id AS GrupoID', 'grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.id AS EmpresasID', 'empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        $contas = $this->contas->find($id);
        return view('inventario.contas.edit', compact('contas','operadoras','grupos','empresas'));
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
        $user = Auth::user();
        $user_id = Auth::id();
        
        $dataForm = $request->all();
        $contas  = $this->contas->find($id);
        $old_contas  = $this->contas->find($id);
        $update   = $contas->update($dataForm);

        #if($contas->conta != $old_contas->conta)
        #{
            #event(new LogSistema(" A conta a $old_contas->conta foi alterada $contas->conta.", "contas", $user_id));
        #}

        if ($update)
            return redirect()->route('contas.index')->with('success', "A conta {$old_contas->conta} foi atualizada com sucesso!");
        else
            return redirect()->route('contas.edit')->with('error', "Houve um erro ao editar a conta {$contas->conta}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contas = $this->contas->find($id);
        $delete = $contas->delete();

        if ($delete) {
            return redirect()->route('contas.index')->with('success', "A conta {$contas->conta} foi excluida com sucesso!");
        } else
            return redirect()->route('contas.index')->with('error', "Houve um erro ao excluir a conta {$contas->conta}.");
    }
}
