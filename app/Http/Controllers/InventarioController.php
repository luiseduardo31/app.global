<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Contas;
use App\Models\Planos;
use App\Models\Gestores;
use App\Models\TiposLinha;
use App\Models\Status;
use App\Models\Setores;
use App\Models\Subsetores;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    private $inventario;


    public function __construct(inventario $inventario)
    {
        $this->inventario = $inventario;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inventario $inventario)
    {
        
        $linhas = DB::table('inventarios')->orderBy('nome_usuario','ASC')
        ->select(array('inventarios.observacao as obsInventario', 'inventarios.id as idInventario','inventarios.*','contas.*','planos.*','gestores.*',
                       'setores.*','subsetores.*','status.*','tipos_linhas.*','ultimos_usuarios.*'))
        ->join('contas','contas.id','=','inventarios.conta_id')
        ->join('planos', 'planos.id', '=', 'inventarios.plano_id')
        ->join('gestores', 'gestores.id', '=', 'inventarios.gestor_id')
        ->join('setores', 'setores.id', '=', 'inventarios.setor_id')
        ->join('subsetores', 'subsetores.id', '=', 'inventarios.subsetor_id')
        ->join('status', 'status.id', '=', 'inventarios.status_id')
        ->join('tipos_linhas', 'tipos_linhas.id', '=', 'inventarios.tipo_linha_id')
        ->join('ultimos_usuarios', 'ultimos_usuarios.linha', '=', 'inventarios.linha')
        ->get();


        return view('admin.pages.inventario.index',compact('linhas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $contas = Contas::all(['id', 'conta'])->sortBy('conta');
        $planos = Planos::all(['id', 'plano'])->sortBy('plano');
        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $gestores = Gestores::all(['id', 'gestor'])->sortBy('gestor');
        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $status = Status::all(['id', 'status'])->sortBy('status');
        $setores = Setores::all(['id', 'setor'])->sortBy('setor');
        $subsetores = Subsetores::all(['id', 'subsetor'])->sortBy('subsetor');
        return view('admin.pages.inventario.create',
               compact('contas','planos','gestores','tipos_linha','status','setores','subsetores')); 
        
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
        $insert = $this->inventario->insert($dataForm);

        if ($insert)
            return redirect()->route('inventario.index')->with('success', "A linha {$request->linha} foi cadastrada com sucesso!");
        else 
            return 'Erro ao cadastrar...';
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
        $contas = Contas::all(['id', 'conta'])->sortBy('conta');
        $planos = Planos::all(['id', 'plano'])->sortBy('plano');
        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $gestores = Gestores::all(['id', 'gestor'])->sortBy('gestor');
        $tipos_linha = TiposLinha::all(['id', 'tipo'])->sortBy('tipo');
        $status = Status::all(['id', 'status'])->sortBy('status');
        $setores = Setores::all(['id', 'setor'])->sortBy('setor');
        $subsetores = Subsetores::all(['id', 'subsetor'])->sortBy('subsetor');

        $inventario = $this->inventario->find($id);
        return view('admin.pages.inventario.edit',
               compact('contas', 'planos', 'gestores', 'tipos_linha', 
                       'status', 'setores', 'subsetores','inventario'));
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
        $inventario  = $this->inventario->find($id);
        $update   = $inventario->update($dataForm);

        if ($update)
            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi atualizada com sucesso!");
        else
            return redirect()->route('inventario.edit',  $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = $this->inventario->find($id);
        $delete = $inventario->delete();

        if ($delete) {
            return redirect()->route('inventario.index')->with('success', "A linha {$inventario->linha} foi excluida com sucesso!");
        } else
            return redirect()->route('inventario.show', $id);
    }
}
