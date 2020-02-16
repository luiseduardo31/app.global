<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
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
        ->join('contas','contas.idConta','=','inventarios.FK_idConta')
        ->join('planos', 'planos.idPlano', '=', 'inventarios.FK_idPlano')
        ->join('gestores_departamento', 'gestores_departamento.idGestorDepartamento', '=', 'inventarios.FK_idGestorDepartamento')
        ->join('setores', 'setores.idSetor', '=', 'inventarios.FK_idSetor')
        ->join('subsetores', 'subsetores.idSubsetor', '=', 'inventarios.FK_idSubSetor')
        ->join('status_linhas', 'status_linhas.idStatusLinha', '=', 'inventarios.FK_idStatusLinha')
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
