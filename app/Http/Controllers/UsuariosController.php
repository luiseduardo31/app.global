<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\TiposUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
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
        $usuarios = DB::table('users')->orderBy('name', 'asc')
            ->select(array('tipos_usuarios.id AS TipoUsuarioID', 'tipos_usuarios.*', 'users.*'))
            ->join('tipos_usuarios', 'tipos_usuarios.id', '=', 'users.tipo_usuario_id')
            ->where('users.id','>',1)
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $insert = $this->usuarios->insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return 'ola';
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos_usuarios = TiposUsuarios::all(['id', 'tipo_usuario'])->sortBy('tipo_usuario');

        $usuarios = Usuarios::all(['id', 'name','email','tipo_usuario_id']);
        $usuarios = $this->usuarios->find($id);

        return view('usuarios.edit', compact('usuarios', 'tipos_usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $usuarios  = $this->usuarios->find($id);
        if($id > 1)
        {
            if ($data['password'] != '') 
            {
                $update   = $usuarios->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'tipo_usuario_id' => $data['tipo_usuario_id'],
                    'observacao' => $data['observacao'],
                ]);
            }
            else 
            {
                $update   = $usuarios->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'tipo_usuario_id' => $data['tipo_usuario_id'],
                    'observacao' => $data['observacao'],
                ]);  
            }
        }

        if ($update)
            return redirect()->route('usuarios.index')->with('success', "O usuário {$usuarios->email} foi atualizado com sucesso!");
        else
            return redirect()->route('usuarios.edit')->with('error', "Houve um erro ao editar o usuário {$usuarios->email}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = $this->usuarios->find($id);
        $delete = $usuarios->delete();

        if ($delete) {
            return redirect()->route('usuarios.index')->with('success', "O usuário {$usuarios->name} foi excluido com sucesso!");
        } else
            return redirect()->route('usuarios.index')->with('error', "Houve um erro ao excluir o usuário {$usuarios->name}.");
    }
}
