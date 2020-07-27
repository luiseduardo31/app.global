<?php

namespace App\Http\Controllers;

use App\Models\Grupos;
use Illuminate\Http\Request;


class GruposController extends Controller
{

    public function __construct(Grupos $grupos)
    {
        $this->grupos = $grupos;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupos::all(['id', 'grupo','observacao'])->sortBy('grupo');

        return view('inventario.grupos.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.grupos.create');
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
        $insert = $this->grupos->insert($dataForm);

        if ($insert)
            return redirect()->route('grupos.index')->with('success', "O grupo {$request->grupo} foi cadastrado com sucesso!");
        else
            return redirect()->route('grupos.create')->with('error', "Houve um erro ao cadastrar o grupo {$request->gestor}.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function show(Grupos $grupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupos = Grupos::all(['id', 'grupo', 'observacao']);
        $grupos = $this->grupos->find($id);

        return view('inventario.grupos.edit', compact('grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $grupos  = $this->grupos->find($id);
        $update   = $grupos->update($dataForm);

        if ($update)
            return redirect()->route('grupos.index')->with('success', "O grupo {$grupos->grupo} foi atualizado com sucesso!");
        else
            return redirect()->route('grupos.edit')->with('error', "Houve um erro ao editar o grupo {$grupos->grupo}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupos = $this->grupos->find($id);
        $delete = $grupos->delete();

        if ($delete) {
            return redirect()->route('grupos.index')->with('success', "O grupo {$grupos->grupo} foi excluido com sucesso!");
        } else
            return redirect()->route('grupos.index')->with('error', "Houve um erro ao excluir o grupo {$grupos->grupo}.");
    }
}
