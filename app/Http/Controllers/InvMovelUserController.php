<?php

namespace App\Http\Controllers;

use App\Models\InvMoveluser;
use Illuminate\Http\Request;
use App\Models\Setores;
use App\Models\Subsetores;
use App\Models\Filiais;
use App\Models\Funcoes;
use App\Models\Grupos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class InvMovelUserController extends Controller
{

    private $linha;


    public function __construct(InvMoveluser $linha)
    {
        $this->linha = $linha;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.inventario-movel-user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\InvMoveluser  $invMoveluser
     * @return \Illuminate\Http\Response
     */
    public function show(InvMoveluser $invMoveluser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvMoveluser  $invMoveluser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_crypt = $id;
        $id = Crypt::decrypt($id);
        $linha = $this->linha->find($id);
        
        if($linha->token == $id_crypt) {

            $grupos = DB::table('grupos')->orderBy('grupo', 'ASC')
                ->select(array('grupos.id AS grupoID', 'grupos.*', 'grupos_users.*'))
                ->join('grupos_users', 'grupos_users.grupos_id', '=', 'grupos.id')
                ->get();


            $linha = $this->linha->find($id);
            return view(
                'inventario.inventario-movel-user.edit',
                compact(
                    'grupos',
                    'linha'
                )
            );
        }
        else {
           return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvMoveluser  $invMoveluser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $linha  = $this->linha->find($id);
        $update   = $linha->update($data);

        if($update) 
            return redirect()->route('minha-linha.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvMoveluser  $invMoveluser
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvMoveluser $invMoveluser)
    {
        //
    }
}
