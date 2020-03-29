<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcoes;
use Illuminate\Support\Facades\DB;

class FuncoesController extends Controller
{

    public function __construct(Funcoes $funcoes)
    {
        $this->funcoes = $funcoes;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Funcoes $funcoes)
    {
        $funcoes = DB::table('funcoes')->orderBy('funcao','asc')
        ->get();
        return view('inventario.funcoes.index', compact('funcoes'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.funcoes.create');
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
        $insert = $this->funcoes->insert($dataForm);

        if ($insert)
            return redirect()->route('funcoes.index')->with('success', "A Função {$request->funcao} foi cadastrada com sucesso!");
        else
            return redirect()->route('funcoes.create')->with('error', "Houve um erro ao cadastrar a função {$request->funcao}.");
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
        $funcoes = Funcoes::all(['id', 'funcao','observacao'])->sortBy('funcao');
        $funcoes = $this->funcoes->find($id);
        return view('inventario.funcoes.edit', compact('funcoes'));
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
        $funcoes  = $this->funcoes->find($id);
        $update   = $funcoes->update($dataForm);

        if ($update)
            return redirect()->route('funcoes.index')->with('success', "A Função {$funcoes->funcao} foi atualizada com sucesso!");
        else
            return redirect()->route('funcoes.edit')->with('error', "Houve um erro ao editar a função {$funcoes->funcao}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcoes = $this->funcoes->find($id);
        $delete = $funcoes->delete();

        if ($delete) {
            return redirect()->route('funcoes.index')->with('success', "A Função {$funcoes->funcao} foi excluida com sucesso!");
        } else
            return redirect()->route('funcoes.index')->with('error', "Houve um erro ao excluir a função {$funcoes->funcao}.");
    }
}
