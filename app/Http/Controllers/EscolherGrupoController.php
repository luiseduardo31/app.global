<?php

namespace App\Http\Controllers;

use App\Models\EscolherGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EscolherGrupoController extends Controller
{

    public function __construct(EscolherGrupo $EscolherGrupo)
    {
        $this->EscolherGrupo = $EscolherGrupo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('session_grupo_id');
     
        $user_id = Auth::id();

        $grupos = DB::table('grupos_users')
        ->select(array('grupos.id AS GruposID','users.id AS UsersID', 'grupos_users.*', 'grupos.*'))
        ->join('grupos', 'grupos.id', '=', 'grupos_users.grupos_id')
        ->join('users', 'users.id', '=', 'grupos_users.users_id')
        ->where('users_id', $user_id)
        ->get();

        return view('escolhergrupo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->put('session_grupo_id', $request->grupo);
        session()->put('session_grupo_nome', $request->grupo_nome);
        return redirect()->route('inventario.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EscolherGrupo  $escolherGrupo
     * @return \Illuminate\Http\Response
     */
    public function show(EscolherGrupo $escolherGrupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EscolherGrupo  $escolherGrupo
     * @return \Illuminate\Http\Response
     */
    public function edit(EscolherGrupo $escolherGrupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EscolherGrupo  $escolherGrupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EscolherGrupo $escolherGrupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EscolherGrupo  $escolherGrupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EscolherGrupo $escolherGrupo)
    {
        //
    }
}
