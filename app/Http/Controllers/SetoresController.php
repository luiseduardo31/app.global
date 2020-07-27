<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SetoresController extends Controller
{
    public function __construct(Setores $setores)
    {
        $this->setores = $setores;
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

        $setores = DB::table('setores')->orderBy('setor', 'asc')
            ->select(array('setores.observacao AS obsSetor','setores.id AS SetorID', 'setores.*', 'grupos_users.*', 'grupos.*'))
            ->join('grupos', 'grupos.id', '=', 'setores.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'setores.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        return view('inventario.setores.index',compact('setores'));
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

        return view('inventario.setores.create',compact('grupos'));
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
        $insert = $this->setores->insert($dataForm);

        if ($insert)
            return redirect()->route('setores.index')->with('success', "O setor {$request->setor} foi cadastrado com sucesso!");
        else
            return redirect()->route('setores.create')->with('error', "Houve um erro ao cadastrar o setor {$request->setor}.");
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

        $setores = Setores::all(['id', 'setor', 'observacao'])->sortBy('setor');
        $setores = $this->setores->find($id);

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id as GrupoID', 'grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();
        return view('inventario.setores.edit', compact('setores','grupos'));
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
        $setores  = $this->setores->find($id);
        $update   = $setores->update($dataForm);

        if ($update)
            return redirect()->route('setores.index')->with('success', "O setor {$setores->setor} foi atualizado com sucesso!");
        else
            return redirect()->route('setores.edit')->with('error', "Houve um erro ao editar o setor {$setores->setor}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setores = $this->setores->find($id);
        $delete = $setores->delete();

        if ($delete) {
            return redirect()->route('setores.index')->with('success', "O setor {$setores->setor} foi excluido com sucesso!");
        } else
            return redirect()->route('setores.index')->with('error', "Houve um erro ao excluir o setor {$setores->setor}.");
    }
}
