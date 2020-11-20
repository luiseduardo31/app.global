<?php

namespace App\Http\Controllers;

use App\Models\ContratosMovel;
use App\Models\Contratos;
use Illuminate\Http\Request;
use App\Models\Operadoras;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContratosMovelController extends Controller
{

    public function __construct(Contratos $contratos, ContratosMovel $contratosMovel)
    {
        $this->ContratosMovel = $contratosMovel;
        $this->ContratosGeral = $contratos;
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

        $idGrupo = session()->get('session_grupo_id');

        # $idGrupo != "0" - Lógica para exibir os dados de somente um grupo ou todos.
        if ($idGrupo != "0") {

            $contratos = DB::table('contratos')->orderBy('contrato', 'ASC')
            ->select(array(
                'contratos.*', 'contratos_moveis.*',
                'contratos.observacao as obsContrato', 'contratos.id as ContratoID',
                'operadoras.*', 'empresas.*', 'grupos_users.*'))
            ->join('contratos_moveis', 'contratos_moveis.contrato_id', '=', 'contratos.id')
            ->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->where('empresas.grupo_id', $idGrupo)
            ->get();

        } else {

            $contratos = DB::table('contratos')->orderBy('contrato', 'ASC')
            ->select(array(
                'contratos.*', 'contratos_moveis.*',
                'contratos.observacao as obsContrato', 'contratos.id as ContratoID',
                'operadoras.*', 'empresas.*', 'grupos_users.*'
            ))
                ->join('contratos_moveis', 'contratos_moveis.contrato_id', '=', 'contratos.id')
                ->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')
                ->join('operadoras', 'operadoras.id', '=', 'contratos.operadora_id')
                ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
                ->where('users_id', $user_id)
                ->get();
        }
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
        $idGrupo = session()->get('session_grupo_id');

        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
        ->select(array('operadoras.*'))
        ->where('tipo_operadora', '1')
        ->get();

        if ($idGrupo != "0") {
            $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
                ->select(array(
                    'empresas.id AS EmpresaID', 'empresas.*', 'grupos_users.*',
                    'grupos.id AS GrupoID', 'grupos.*'
                ))
                ->join('grupos', 'grupos.id', '=', 'empresas.grupo_id')
                ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
                ->where('users_id', $user_id)
                ->where('empresas.grupo_id', $idGrupo)
                ->get();
        }
        else {
            $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
                ->select(array(
                    'empresas.id AS EmpresaID', 'empresas.*', 'grupos_users.*',
                    'grupos.id AS GrupoID', 'grupos.*'
                ))
                ->join('grupos', 'grupos.id', '=', 'empresas.grupo_id')
                ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
                ->where('users_id', $user_id)
                ->get();
        }

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
