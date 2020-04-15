<?php

namespace App\Http\Controllers;

use App\Models\ContratosFixo;
use Illuminate\Http\Request;
use App\Models\Operadoras;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContratosFixoController extends Controller
{
    public function __construct(ContratosFixo $contratosFixo)
    {
        $this->ContratosFixo = $contratosFixo;
        $this->middleware('auth'); 
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

        $operadoras = Operadoras::all(['id', 'operadora'])->sortBy('operadora');
        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        return view('contratos.fixo.create',compact('operadoras', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function show(ContratosFixo $contratosFixo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function edit(ContratosFixo $contratosFixo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratosFixo $contratosFixo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratosFixo $contratosFixo)
    {
        //
    }
}
