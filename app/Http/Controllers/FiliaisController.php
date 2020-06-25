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
            ->select(array('filiais.id AS filialID','filiais.*', 'grupos_users.*', 'grupos.*'))
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
        $user = Auth::user();
        $user_id = Auth::id();

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
        ->select(array('grupos.id AS GrupoID','grupos.*', 'grupos_users.*'))
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
        ->where('users_id', $user_id)
        ->get();

        return view('inventario.filiais.create', compact('grupos'));
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
            return redirect()->route('filiais.index')->with('success', "A filial {$request->filial} foi cadastrada com sucesso!");
        else
            return redirect()->route('filiais.create')->with('error', "Houve um erro ao cadastrar a filial {$request->filial}.");
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
        
        $filiais = Filiais::all(['id', 'filial', 'observacao'])->sortBy('matricula');
        $filiais = $this->filiais->find($id);

        $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
        ->select(array('grupos.id as GrupoID', 'grupos.*', 'grupos_users.*'))
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
        ->where('users_id', $user_id)
        ->get();

        return view('inventario.filiais.edit', compact('filiais','grupos'));
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
            return redirect()->route('filiais.index')->with('success', "A filial {$filiais->filial} foi atualizada com sucesso!");
        else
            return redirect()->route('filiais.edit')->with('error', "Houve um erro ao editar a filial {$filiais->filial}.");
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
            return redirect()->route('filiais.index')->with('success', "A filial {$filiais->filial} foi excluida com sucesso!");
        } else
            return redirect()->route('filiais.index')->with('error', "Houve um erro ao excluir a filial {$filiais->filial}.");
    }
}
