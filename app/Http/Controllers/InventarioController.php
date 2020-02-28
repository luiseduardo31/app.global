<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Contas;
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
        $linhas = DB::table('inventarios')
        ->select(array('inventarios.observacao as obsInventario','inventarios.*','contas.*','planos.*','gestores.*',
                       'setores.*','subsetores.*','status.*','tipos_linhas.*'))
        ->join('contas','contas.id','=','inventarios.conta_id')
        ->join('planos', 'planos.id', '=', 'inventarios.plano_id')
        ->join('gestores', 'gestores.id', '=', 'inventarios.gestor_id')
        ->join('setores', 'setores.id', '=', 'inventarios.setor_id')
        ->join('subsetores', 'subsetores.id', '=', 'inventarios.subsetor_id')
        ->join('status', 'status.id', '=', 'inventarios.status_id')
        ->join('tipos_linhas', 'tipos_linhas.id', '=', 'inventarios.tipo_linha_id')
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
        $contas = Contas::all(['id', 'conta'])->sortBy('conta');;
        return view('admin.pages.inventario.create',compact('contas')); 
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
