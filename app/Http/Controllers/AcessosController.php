<?php

namespace App\Http\Controllers;

use App\Models\Acessos;
use App\Models\Grupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AcessosController extends Controller
{
    public function __construct(Acessos $acessos)
    {
        $this->acessos = $acessos;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acessos = DB::table('grupos_users')
            ->select(array('grupos_users.observacao AS obsAcesso','users.id AS userID','grupos.id AS grupoID','users.*', 'grupos.*', 'grupos_users.*'))
            ->join('grupos', 'grupos.id', '=', 'grupos_users.grupos_id')
            ->join('users', 'users.id', '=', 'grupos_users.users_id')
            ->get();

        return view('acessos.index',compact('acessos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $grupos = Grupos::all(['id', 'grupo'])->sortByDesc('grupo');

        $usuarios = DB::table('users')->orderBy('name', 'ASC')->get();


        return view('acessos.create', compact('grupos','usuarios'));
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
        $insert = $this->acessos->insert($dataForm);

        if ($insert)
            return redirect()->route('acessos.index')->with('success', "O acesso do usuario {$request->grupo_id} para o grupo{$request->grupo} foi cadastrado com sucesso!");
        else
            return redirect()->route('acessos.create')->with('error', "Houve um erro ao cadastrar o acesso do usuario {$request->name} para o grupo {$request->grupo}.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acessos  $acessos
     * @return \Illuminate\Http\Response
     */
    public function show(Acessos $acessos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acessos  $acessos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acessos = DB::table('grupos_users')->get();
        $acessos = $this->acessos->find($id);

        $grupos = Grupos::all(['id', 'grupo'])->sortByDesc('grupo');
        $usuarios = DB::table('users')->orderBy('name', 'ASC')->get();

        return view('acessos.edit', compact('acessos','usuarios', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acessos  $acessos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $acessos  = $this->acessos->find($id);
        $update   = $acessos->update($dataForm);

        if ($update)
            return redirect()->route('acessos.index')->with('success', "O acesso {$acessos->id} foi atualizado com sucesso!");
        else
            return redirect()->route('acessos.edit')->with('error', "Houve um erro ao editar o acesso {$acessos->id}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acessos  $acessos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acessos = $this->acessos->find($id);
        $delete = $acessos->delete();

        if ($delete) {
            return redirect()->route('acessos.index')->with('success', "O acesso {$acessos->id} foi excluido com sucesso!");
        } else
            return redirect()->route('acessos.index')->with('error', "Houve um erro ao excluir o acesso {$acessos->id}.");
    }
}
