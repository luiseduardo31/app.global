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
    public function index(ContratosFixo $contratosFixo)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $contratos = DB::table('contratos_fixos')->orderBy('numero_contrato', 'ASC')
            ->select(array(
                'contratos_fixos.observacao as obsContrato', 'contratos_fixos.id as idContrato', 'contratos_fixos.*', 
                'operadoras.*', 'empresas.*','grupos_users.*'
            ))
            ->join('empresas', 'empresas.id', '=', 'contratos_fixos.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos_fixos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();


        return view('contratos.fixo.index', compact('contratos'));
        
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
        $dataForm = $request->except('_token');
        $insert = $this->ContratosFixo->insert($dataForm);

        if ($insert)
            return redirect()->route('contratos-fixo.index')->with('success', "O contrato {$request->numero_contrato} foi cadastrado com sucesso!");
        else
            return redirect()->route('contratos-fixo.create')->with('error', "Houve um erro ao cadastrar o contrato {$request->numero_contrato}.");
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
    public function edit($id)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        
        $contratos = ContratosFixo::all();
        $contratos = $this->ContratosFixo->find($id);
        $operadoras = Operadoras::all(['id', 'operadora'])->sortBy('operadora');
        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        return view('contratos.fixo.edit', compact('contratos','operadoras','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $contratos  = $this->ContratosFixo->find($id);
        $update   = $contratos->update($dataForm);

        if ($update)
            return redirect()->route('cadastros-fixo.index')->with('success', "O  contrato {$contratos->numero_contrato} foi atualizado com sucesso!");
        else
            return redirect()->route('cadastros-fixo.edit')->with('error', "Houve um erro ao editar o contrato {$contratos->numero_contrato}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratos = $this->ContratosFixo->find($id);
        $delete = $contratos->delete();

        if ($delete) {
            return redirect()->route('contratos-fixo.index')->with('success', "O contrato {$contratos->numero_contrato} foi excluido com sucesso!");
        } else
            return redirect()->route('contratos-fixo.index')->with('error', "Houve um erro ao excluir o contrato {$contratos->numero_contrato}.");
    }
}
