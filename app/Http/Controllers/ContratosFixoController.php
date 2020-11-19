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


class ContratosFixoController extends Controller
{
    public function __construct(Contratos $contratos, ContratosFixo $contratosFixo)
    {
        $this->ContratosFixo = $contratosFixo;
        $this->ContratosGeral = $contratos;
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

        $contratos = DB::table('contratos')->orderBy('contrato', 'ASC')
            ->select(array('contratos.*', 'contratos_fixos.*',
            'contratos.observacao as obsContrato', 'contratos.id as ContratoID', 
            'operadoras.*', 'empresas.*','grupos_users.*'))
            ->join('contratos_fixos', 'contratos_fixos.contrato_id', '=', 'contratos.id')
            ->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')
            ->join('operadoras', 'operadoras.id', '=', 'contratos.operadora_id')
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
        $idGrupo = session()->get('session_grupo_id');

        $operadoras = DB::table('operadoras')->orderBy('operadora', 'ASC')
        ->select(array('operadoras.*'))
        ->where('tipo_operadora', '2')
            ->get();

        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
        ->select(array('empresas.id AS EmpresaID','empresas.*', 'grupos_users.*'))
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
            'tarifa_ld_movel'
        );

        $insert = $this->ContratosGeral->insert($data_contrato);

        #Obtendo o ultimo registro inserido.
        $registro_id = DB::getPDO()->lastInsertId();

        if($insert){
            $insert_detalhes = $this->ContratosFixo->insert([
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
        $user = Auth::user();
        $user_id = Auth::id();
        
        $contratos = $this->ContratosGeral->find($id);
        $detalhes_contrato = ContratosFixo::where('contrato_id', $contratos->id)->first();
        
        
        $operadoras = Operadoras::all(['id', 'operadora'])->sortBy('operadora');
        $empresas = DB::table('empresas')->orderBy('razao_social', 'ASC')
            ->select(array('empresas.*', 'grupos_users.*','empresas.id AS EmpresaID'))
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'empresas.grupo_id')
            ->where('users_id', $user_id)
            ->get();
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
            'tarifa_ld_movel'
        );

        $contratos  = $this->ContratosGeral->find($id);
        $update   = $contratos->update($data_contrato);

        if ($update) {
            $update_detalhes = $request->only(
                'franquia',
                'comprometimento_minimo',
                'range',
                'canais',
                'sinalizacao',
                'tarifa_local_fixo',
                'tarifa_local_movel',
                'tarifa_ld_fixo',
                'tarifa_ld_movel'
            );
            $detalhes_contrato  = $this->ContratosFixo;
            $update = $detalhes_contrato->where('contrato_id', $id)->update($update_detalhes);
            return redirect()->route('contratos-fixo.index')->with('success', "O  contrato {$contratos->contrato} foi atualizado com sucesso!");
        } else {
            return redirect()->route('contratos-fixo.create')->with('error', "Houve um erro ao cadastrar o contrato {$request->contrato}.");
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
