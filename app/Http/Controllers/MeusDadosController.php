<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MeusDadosController extends Controller
{
    public function __construct(Usuarios $usuarios)
    {
        $this->usuarios = $usuarios;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $usuarios = DB::table('users')->orderBy('name', 'asc')
        ->select( 'users.*')
        ->where('users.id', $user_id)
        ->get();

        return view('usuarios.meus-dados-index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeusDados  $meusDados
     * @return \Illuminate\Http\Response
     */
    public function show(MeusDados $meusDados)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeusDados  $meusDados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $usuarios = Usuarios::all(['id', 'name', 'email', 'tipo_usuario_id']);
        $usuarios = $this->usuarios->find($id);

        return view('usuarios.meus-dados-edit', compact('usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeusDados  $meusDados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $usuarios  = $this->usuarios->find($id);
        
        if ($data['password'] != '') {
            $update   = $usuarios->update([
                'password' => Hash::make($data['password']),
            ]);
        }
        if ($update)
            return redirect()->route('meus-dados.index')->with('success', "Sua senha foi atualizada com sucesso!");
        else
            return redirect()->route('meus-dados-edit.edit')->with('error', "Houve um erro ao alterar a sua senha.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeusDados  $meusDados
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeusDados $meusDados)
    {
        //
    }
}
