<?php

namespace App\Http\Controllers;

use App\Models\ContratosFixo;
use App\Models\Contratos;
use Illuminate\Http\Request;
use App\Models\Operadoras;
use App\Models\Empresas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class ContratosFixoController extends Controller
{
    public function __construct(Contratos $contratos, ContratosFixo $contratosFixo)
    {
        $this->ContratosFixo = $contratosFixo;
        $this->ContratosGeral = $contratos;

        $this->middleware('auth');
        $this->middleware('check.permissions')->except([
            'index'
        ]);
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

        $idGrupo = session()->get('session_grupo_id');

        # $idGrupo != "0" - Lógica para exibir os dados de somente um grupo ou todos.
        if ($idGrupo != "0") 
        {

            $contratos = DB::table('contratos')->orderBy('contrato', 'ASC')
            ->select(array(
                'contratos.*', 'contratos_fixos.*',
                'contratos.observacao as obsContrato', 'contratos.id as ContratoID',
                 'operadoras.*', 'empresas.*', 'grupos_users.*'))
            ->join('contratos_fixos', 'contratos_fixos.contrato_id', '=', 'contratos.id')
            ->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->where('empresas.grupo_id', $idGrupo)
            ->get();
        }
        else
        {
            $contratos = DB::table('contratos')->orderBy('contrato', 'ASC')
            ->select(array(
                'contratos.*', 'contratos_fixos.*',
                'contratos.observacao as obsContrato', 'contratos.id as ContratoID',
                'operadoras.*', 'empresas.*', 'grupos_users.*'
            ))
            ->join('contratos_fixos', 'contratos_fixos.contrato_id', '=', 'contratos.id')
            ->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos.operadora_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
        }

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
        $idGrupo = session()->get('session_grupo_id');

        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
        ->select(array('operadoras.*'))
        ->where('tipo_operadora', '2')
        ->get();

        if ($idGrupo != "0") {
            $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.id AS EmpresaID', 'empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
                ->where('empresas.grupo_id', $idGrupo)
                ->get();
        } else {
            $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.id AS EmpresaID', 'empresas.*', 'grupos_users.*'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
                ->get();
        }
        
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

        $data = $request->all();

        $vlr_assinatura = str_replace('.', '', $request->assinatura);
        $vlr_assinatura = str_replace(',', '.', $vlr_assinatura);


        $data_contrato = $this->ContratosGeral->insert([
            'contrato' => $data['contrato'],
            'operadora_id' => $data['operadora_id'],
            'empresa_id' => $data['empresa_id'],
            'assinatura' => $vlr_assinatura,
            'vigencia' => $data['vigencia'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
            'tipo_contrato' => '1',
            'status_contrato' => $data['status_contrato'],
            'observacao' => $data['observacao'],
        ]);

        #Obtendo o ultimo registro inserido.
        $registro_id = DB::getPDO()->lastInsertId();

        $data_det = $request->all();

        $vlr_comp_minimo = str_replace('.', '', $request->comprometimento_minimo);
        $vlr_comp_minimo = str_replace(',', '.', $vlr_comp_minimo);

        if($data_contrato){
            $insert_detalhes = $this->ContratosFixo->insert([
                    'franquia' => $data_det['franquia'],
                    'comprometimento_minimo' => $vlr_comp_minimo,
                    'range' => $data_det['range'],
                    'canais' => $data_det['canais'],
                    'sinalizacao' => $data_det['sinalizacao'],
                    'tarifa_local_fixo' => $data_det['tarifa_local_fixo'],
                    'tarifa_local_movel' => $data_det['tarifa_local_movel'],
                    'tarifa_ld_fixo' => $data_det['tarifa_ld_fixo'],
                    'tarifa_ld_movel' => $data_det['tarifa_ld_movel'],
                    'contrato_id' => $registro_id,
                ]);
        }
        else{
            return redirect()->route('contratos-fixo.create')->with('error', "Houve um erro ao cadastrar o contrato {$request->contrato}.");
        }
           

        if ($insert_detalhes)
            return redirect()->route('contratos-fixo.index')->with('success', "O contrato {$request->contrato} foi cadastrado com sucesso!");
        else
            return redirect()->route('contratos-fixo.create')->with('error', "Houve um erro ao cadastrar os detalhes do contrato {$request->contrato}.");
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
        $id = Crypt::decrypt($id);
        $user = Auth::user();
        $user_id = Auth::id();
        $idGrupo = session()->get('session_grupo_id');
        
        $contratos = $this->ContratosGeral->find($id);
        $detalhes_contrato = ContratosFixo::where('contrato_id', $contratos->id)->first();


        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
        ->select(array('operadoras.*'))
        ->where('tipo_operadora', '2')
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
        } else {
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

        return view('contratos.fixo.edit', compact('contratos', 'detalhes_contrato','operadoras','empresas'));
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
        $vlr_assinatura = str_replace('.','', $request->assinatura);
        $vlr_assinatura = str_replace(',', '.', $vlr_assinatura);

        $data = $request->all();
        $contratos  = $this->ContratosGeral->find($id);

        $data_contrato = $contratos->update([
            'contrato' => $data['contrato'],
            'operadora_id' => $data['operadora_id'],
            'empresa_id' => $data['empresa_id'],
            'assinatura' => $vlr_assinatura,
            'vigencia' => $data['vigencia'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
            'tipo_contrato' => '1',
            'status_contrato' => $data['status_contrato'],
            'observacao' => $data['observacao'],
        ]);


        if ($data_contrato) {

            $data_det = $request->all();
            $contratoFixo  = $this->ContratosFixo;

            $vlr_comp_minimo = str_replace('.', '', $request->comprometimento_minimo);
            $vlr_comp_minimo = str_replace(',', '.', $vlr_comp_minimo);

            $data_contrato = $contratoFixo->where('contrato_id', $id)->update([
                'franquia' => $data_det['franquia'],
                'comprometimento_minimo' => $vlr_comp_minimo,
                'range' => $data_det['range'],
                'canais' => $data_det['canais'],
                'sinalizacao' => $data_det['sinalizacao'],
                'tarifa_local_fixo' => $data_det['tarifa_local_fixo'],
                'tarifa_local_movel' => $data_det['tarifa_local_movel'],
                'tarifa_ld_fixo' => $data_det['tarifa_ld_fixo'],
                'tarifa_ld_movel' => $data_det['tarifa_ld_movel'],
            ]);
            
            return redirect()->route('contratos-fixo.index')->with('success', "O  contrato {$contratos->contrato} foi atualizado com sucesso!");
        } else {
            return redirect()->route('contratos-fixo.index')->with('error', "Houve um erro ao editar o contrato {$request->contrato}.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Contratos\ContratosFixo  $contratosFixo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratos = $this->ContratosGeral->find($id);
        $delete = $contratos->delete();

        if ($delete) {
            return redirect()->route('contratos-fixo.index')->with('success', "O contrato {$contratos->contrato} foi excluido com sucesso!");
        } else
            return redirect()->route('contratos-fixo.index')->with('error', "Houve um erro ao excluir o contrato {$contratos->contrato}.");
    }
}
