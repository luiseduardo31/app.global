<?php

namespace App\Http\Controllers;

use App\Models\ContratosMovel;
use Illuminate\Http\Request;
use App\Models\Operadoras;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContratosMovelController extends Controller
{

    public function __construct(ContratosMovel $contratosMovel)
    {
        $this->ContratosMovel = $contratosMovel;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContratosMovel $contratosMovel)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $contratos = DB::table('contratos_moveis')
            ->select(array(
                'contratos_moveis.observacao as obsContrato', 'contratos_moveis.id as idContrato', 'contratos_moveis.*',
                'operadoras.*', 'empresas.*', 'grupos_users.*'))
            ->join('empresas', 'empresas.id', '=', 'contratos_moveis.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos_moveis.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();


        return view('contratos.movel.index', compact('contratos'));
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

        $operadoras = Operadoras::all();
        $empresas = DB::table('empresas')
            ->select(array('empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
            return view('contratos.movel.create',compact('operadoras','empresas'));
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
        $insert = $this->ContratosMovel->insert($dataForm);

        if ($insert)
            return redirect()->route('contratos-movel.index')->with('success', "O contrato {$request->numero_contrato} foi cadastrado com sucesso!");
        else
            return redirect()->route('contratos-movel.create')->with('error', "Houve um erro ao cadastrar o contrato {$request->numero_contrato}.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContratosMovel  $contratosMovel
     * @return \Illuminate\Http\Response
     */
    public function show(ContratosMovel $contratosMovel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContratosMovel  $contratosMovel
     * @return \Illuminate\Http\Response
     */
    public function edit(ContratosMovel $contratosMovel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContratosMovel  $contratosMovel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratosMovel $contratosMovel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContratosMovel  $contratosMovel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratosMovel $contratosMovel)
    {
        //
    }
}
