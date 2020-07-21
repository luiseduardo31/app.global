<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Planos;
use App\Models\Operadoras;
use Illuminate\Support\Facades\Auth;

class PlanosController extends Controller
{

    public function __construct(Planos $planos)
    {
        $this->planos = $planos;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Planos $planos)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $user = Auth::user();
        $user_id = Auth::id();

        $planos = DB::table('planos')->orderBy('plano', 'asc')
            ->select(array('planos.id as planoID', 'planos.observacao AS obsPlano','operadoras.id AS OperadoraID', 'planos.*', 'grupos_users.*', 'grupos.*','operadoras.*'))
            ->join('grupos', 'grupos.id', '=', 'planos.grupo_id')
            ->join('operadoras', 'operadoras.id', '=', 'planos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'planos.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        return view('inventario.planos.index', compact('planos'));
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
        
        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
            ->select(array('operadoras.*'))
            ->where('tipo_operadora', '1')
            ->get();

        return view('inventario.planos.create',compact('grupos','operadoras'));
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
        $insert = $this->planos->insert($dataForm);

        if ($insert)
            return redirect()->route('planos.index')->with('success', "O plano {$request->plano} foi cadastrado com sucesso!");
        else
            return redirect()->route('planos.create')->with('error', "Houve um erro ao cadastrar o plano {$request->plano}.");
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
        
        $planos = Planos::all(['id', 'plano', 'observacao'])->sortBy('plano');
        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
            ->select(array('operadoras.*'))
            ->where('tipo_operadora', '1')
            ->get();

        $planos = $this->planos->find($id);

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id as GrupoID', 'grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        return view('inventario.planos.edit', compact('planos','grupos','operadoras'));
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
        $planos  = $this->planos->find($id);
        $update   = $planos->update($dataForm);

        if ($update)
            return redirect()->route('planos.index')->with('success', "O plano {$planos->plano} foi atualizado com sucesso!");
        else
            return redirect()->route('planos.edit')->with('error', "Houve um erro ao editar o plano {$planos->plano}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $planos = $this->planos->find($id);
        $delete = $planos->delete();

        if ($delete) {
            return redirect()->route('planos.index')->with('success', "O plano {$planos->plano} foi excluido com sucesso!");
        } else
            return redirect()->route('planos.index')->with('error', "Houve um erro ao excluir o plano {$planos->plano}.");
    }
}
