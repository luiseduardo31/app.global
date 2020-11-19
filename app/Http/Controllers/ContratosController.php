<?php

namespace App\Http\Controllers;

use App\Models\Contratos;
use App\Models\ContratosFixo;
use Illuminate\Http\Request;
use App\Models\Operadoras;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContratosController extends Controller
{

    public function __construct(Contratos $contratos, ContratosFixo $contratosFixo)
    {
        $this->ContratosFixo = $contratosFixo;
        $this->Contratos = $contratos;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $idGrupo = session()->get('session_grupo_id');

        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
            ->select(array('operadoras.*'))
            ->where('tipo_operadora', '2')
            ->get();

        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
        ->select(array('empresas.*', 'grupos_users.*'))
        ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
        ->where('users_id', $user_id)
        ->where('empresas.grupo_id', $idGrupo)
        ->get();

        return view('contratos.fixo.create', compact('operadoras', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_contrato = $request->except(
            '_token', 
            'franquia', 
            'comprometimento_minimo', 
            'range',
            'canais',
            'sinalizacao',
            'tarifa_local_fixo',
            'tarifa_local_movel',
            'tarifa_ld_fixo',
            'tarifa_ld_movel');

        $insert = $this->Contratos->insert($data_contrato);

        #Obtendo o ultimo registro inserido.
        $registro_id = DB::getPDO()->lastInsertId();

        return ContratosFixo::create([
            'franquia' => $request['franquia'],
            'comprometimento_minimo' => $request['comprometimento_minimo'],
            'range' => $request['range'],
            'canais' => $request['canais'],
            'sinalizacao' => $request['sinalizacao'],
            'tarifa_local_fixo' => $request['tarifa_local_fixo'],
            'tarifa_local_movel' => $request['tarifa_local_movel'],
            'tarifa_ld_fixo' => $request['tarifa_ld_fixo'],
            'tarifa_ld_movel' => $request['tarifa_ld_movel'],
            'contrato_id' => $registro_id,
        ]);         
       
        if ($insert)
            return redirect()->route('contratos-fixo.index')->with('success', "O contrato {$request->contrato} foi cadastrado com sucesso!");
        else
            return redirect()->route('contratos-fixo.create')->with('error', "Houve um erro ao cadastrar o contrato {$request->contrato}.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function show(Contratos $contratos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function edit(Contratos $contratos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contratos $contratos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratos $contratos)
    {
        //
    }
}
