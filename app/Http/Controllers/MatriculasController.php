<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matriculas;
use Illuminate\Support\Facades\DB;

class MatriculasController extends Controller
{
    public function __construct(Matriculas $matriculas)
    {
        $this->matriculas = $matriculas;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matriculas = DB::table('matriculas')->orderBy('matricula', 'asc')
        ->get();
        return view('inventario.matriculas.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.matriculas.create');
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
        $insert = $this->matriculas->insert($dataForm);

        if ($insert)
            return redirect()->route('matriculas.index')->with('success', "A Matrícula {$request->matricula} foi cadastrada com sucesso!");
        else
            return redirect()->route('matriculas.create')->with('error', "Houve um erro ao cadastrar a Matrícula {$request->matricula}.");
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
        $matriculas = Matriculas::all(['id', 'matricula', 'observacao'])->sortBy('matricula');
        $matriculas = $this->matriculas->find($id);
        return view('inventario.matriculas.edit', compact('matriculas'));
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
        $matriculas = $this->matriculas->find($id);
        $update = $matriculas->update($dataForm);

        if ($update)
            return redirect()->route('matriculas.index')->with('success', "A Matrícula {$matriculas->matricula} foi atualizada com sucesso!");
        else
            return redirect()->route('matriculas.edit')->with('error', "Houve um erro ao editar a Matrícula {$matriculas->matricula}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matriculas = $this->matriculas->find($id);
        $delete = $matriculas->delete();

        if ($delete) {
            return redirect()->route('matriculas.index')->with('success', "A Matrículas {$matriculas->matricula} foi excluida com sucesso!");
        } else
            return redirect()->route('matriculas.index')->with('error', "Houve um erro ao excluir a Matrícula {$matriculas->matricula}.");
    }
}
