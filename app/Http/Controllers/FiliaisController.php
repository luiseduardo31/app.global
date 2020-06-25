<?php

namespace App\Http\Controllers;

use App\Models\Filiais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FiliaisController extends Controller
{
    public function __construct(Filiais $filiais)
    {
        $this->filiais = $filiais;
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

        $filiais = DB::table('filiais')->orderBy('filial', 'asc')
            ->select(array('filiais.id as filialID', 'filiais.*', 'grupos_users.*', 'grupos.*'))
            ->join('grupos', 'grupos.id', '=', 'filiais.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'filiais.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        return view('inventario.filiais.index', compact('filiais'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.filiais.create');
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
        $insert = $this->filiais->insert($dataForm);

        if ($insert)
            return redirect()->route('filiais.index')->with('success', "A Matrícula {$request->matricula} foi cadastrada com sucesso!");
        else
            return redirect()->route('filiais.create')->with('error', "Houve um erro ao cadastrar a Matrícula {$request->matricula}.");
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
        $filiais = Filiais::all(['id', 'matricula', 'observacao'])->sortBy('matricula');
        $filiais = $this->filiais->find($id);
        return view('inventario.filiais.edit', compact('filiais'));
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
        $filiais = $this->filiais->find($id);
        $update = $filiais->update($dataForm);

        if ($update)
            return redirect()->route('filiais.index')->with('success', "A Matrícula {$filiais->matricula} foi atualizada com sucesso!");
        else
            return redirect()->route('filiais.edit')->with('error', "Houve um erro ao editar a Matrícula {$filiais->matricula}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filiais = $this->filiais->find($id);
        $delete = $filiais->delete();

        if ($delete) {
            return redirect()->route('filiais.index')->with('success', "A Matrículas {$filiais->matricula} foi excluida com sucesso!");
        } else
            return redirect()->route('filiais.index')->with('error', "Houve um erro ao excluir a Matrícula {$filiais->matricula}.");
    }
}
