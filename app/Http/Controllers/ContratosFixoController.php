<?php

namespace App\Http\Controllers;

use App\Models\ContratosFixo;
use Illuminate\Http\Request;

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
        return 'Index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Create';
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
