<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestores;
use Illuminate\Support\Facades\DB;

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
        $gestores = DB::table('gestores')->orderBy('gestor','asc')
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
        return view('inventario.gestores.create');
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
        $gestores = Gestores::all(['id', 'gestor', 'observacao'])->sortBy('gestor');
        $gestores = $this->gestores->find($id);
        return view('inventario.gestores.edit', compact('gestores'));
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
            return redirect()->route('gestores.index')->with('success', "O Gestor {$gestores->gestor} foi atualizado com sucesso!");
        else
            return redirect()->route('gestores.edit')->with('error', "Houve um erro ao editar o Gestor {$gestores->gestor}.");
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
            return redirect()->route('gestores.index')->with('success', "O Gestor {$gestores->gestor} foi excluido com sucesso!");
        } else
            return redirect()->route('gestores.index')->with('error', "Houve um erro ao excluir o gestor {$gestores->gestor}.");
    }
}
