<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestoresController extends Controller
{
    public function __construct(Gestores $gestores)
    {
        $this->gestores = $gestores;
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

        $gestores = DB::table('gestores')->orderBy('gestor', 'asc')
            ->select(array('gestores.id AS GestorID', 'gestores.*', 'grupos_users.*', 'grupos.*'))
            ->join('grupos', 'grupos.id', '=', 'gestores.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'gestores.grupo_id')
            ->where('users_id', $user_id)
            ->get();
     
        return view('inventario.gestores.index', compact('gestores'));
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

        return view('inventario.gestores.create',compact('grupos'));
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
        $insert = $this->gestores->insert($dataForm);

        if ($insert)
            return redirect()->route('gestores.index')->with('success', "O Gestor {$request->gestor} foi cadastrado com sucesso!");
        else
            return redirect()->route('gestores.create')->with('error', "Houve um erro ao cadastrar o Gestor {$request->gestor}.");
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

        $gestores = Gestores::all(['id', 'gestor', 'observacao'])->sortBy('gestor');
        $gestores = $this->gestores->find($id);

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
            ->select(array('grupos.id as GrupoID', 'grupos.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
            ->where('users_id', $user_id)
            ->get();

        return view('inventario.gestores.edit', compact('gestores','grupos'));
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
        $gestores  = $this->gestores->find($id);
        $update   = $gestores->update($dataForm);

        if ($update)
            return redirect()->route('gestores.index')->with('success', "O gestor {$gestores->gestor} foi atualizado com sucesso!");
        else
            return redirect()->route('gestores.edit')->with('error', "Houve um erro ao editar o gestor {$gestores->gestor}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gestores = $this->gestores->find($id);
        $delete = $gestores->delete();

        if ($delete) {
            return redirect()->route('gestores.index')->with('success', "O gestor {$gestores->gestor} foi excluido com sucesso!");
        } else
            return redirect()->route('gestores.index')->with('error', "Houve um erro ao excluir o gestor {$gestores->gestor}.");
    }
}
