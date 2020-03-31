<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subsetores;

class SubsetoresController extends Controller
{
    public function __construct(Subsetores $subsetores)
    {
        $this->subsetores = $subsetores;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsetores = DB::table('subsetores')->orderBy('subsetor', 'asc')
        ->get();
        return view('inventario.subsetores.index',compact('subsetores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.subsetores.create');
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
        $insert = $this->subsetores->insert($dataForm);

        if ($insert)
            return redirect()->route('subsetores.index')->with('success', "O subsetor {$request->subsetor} foi cadastrado com sucesso!");
        else
            return redirect()->route('subsetores.create')->with('error', "Houve um erro ao cadastrar o subsetor {$request->subsetor}.");
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
        $subsetores = Subsetores::all(['id', 'subsetor', 'observacao'])->sortBy('susetor');
        $subsetores = $this->subsetores->find($id);
        return view('inventario.subsetores.edit', compact('subsetores'));
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
        $subsetores  = $this->subsetores->find($id);
        $update   = $subsetores->update($dataForm);

        if ($update)
            return redirect()->route('subsetores.index')->with('success', "O subsetor {$subsetores->subsetor} foi atualizado com sucesso!");
        else
            return redirect()->route('subsetores.edit')->with('error', "Houve um erro ao editar o subsetor {$subsetores->subsetor}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsetores = $this->subsetores->find($id);
        $delete = $subsetores->delete();

        if ($delete) {
            return redirect()->route('subsetores.index')->with('success', "O subsetor {$subsetores->subsetor} foi excluido com sucesso!");
        } else
            return redirect()->route('subsetores.index')->with('error', "Houve um erro ao excluir o subsetor {$subsetores->subsetor}.");
    }
}
