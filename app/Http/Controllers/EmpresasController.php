<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupos;
use App\Models\Empresas;


class EmpresasController extends Controller
{

    public function __construct(Empresas $empresas)
    {
        $this->empresas = $empresas;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $empresas = DB::table('empresas')->orderBy('razao_social', 'asc')
            ->select(array('empresas.id AS EmpresaID', 'empresas.observacao AS obsEmpresa', 'empresas.*', 'grupos_users.*', 'grupos.*'))
            ->join('grupos', 'grupos.id', '=', 'empresas.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        return view('inventario.empresas.index', compact('empresas'));
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

        return view('inventario.empresas.create', compact('grupos'));
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
        $insert = $this->empresas->insert($dataForm);

        if ($insert)
            return redirect()->route('empresas.index')->with('success', "A empresa {$request->razao_social} foi cadastrada com sucesso!");
        else
            return redirect()->route('empresas.create')->with('error', "Houve um erro ao cadastrar a empresa {$request->razao_social}.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Empresas $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $empresas = Empresas::all(['id', 'razao_social', 'grupo_id', 'observacao'])->sortBy('razao_social');

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id AS GrupoID', 'grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        $empresas = $this->empresas->find($id);
        return view('inventario.empresas.edit', compact('empresas', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $empresas  = $this->empresas->find($id);
        $update   = $empresas->update($dataForm);

        if ($update)
            return redirect()->route('empresas.index')->with('success', "A empresa {$empresas->razao_social} foi atualizada com sucesso!");
        else
            return redirect()->route('empresas.edit')->with('error', "Houve um erro ao editar a empresa {$empresas->razao_social}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresas $empresas)
    {
        //
    }
}
