<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contas;
use App\Models\Operadoras;
use App\Models\Grupos;
use App\Models\Empresas;
use Illuminate\Support\Facades\Auth;

class ContasController extends Controller
{

    public function __construct(Contas $contas)
    {
        $this->contas = $contas;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //usei para obter os dados do user e listar somente as contas do user logado.
        $user = Auth::user();
        $user_id = Auth::id();

        $contas = DB::table('contas')->orderBy('conta', 'asc')
            ->select(array(
            'contas.*','contas.id as idConta','contas.observacao as obsConta',
            'operadoras.*','operadoras.id as idOperadora',
            'empresas.*','grupos.*'))
            ->join('operadoras', 'operadoras.id', '=', 'contas.operadora_id')
            ->join('empresas', 'empresas.id', '=', 'contas.empresa_id')
            ->join('grupos', 'grupos.id', '=', 'empresas.grupo_id')
            ->where('user_id', $user_id)
            ->get();
        return view('inventario.contas.index', compact('contas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operadoras = Operadoras::all(['id', 'operadora'])->sortBy('operadora');
        return view('inventario.contas.create',compact('operadoras'));
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
        $insert = $this->contas->insert($dataForm);

        if ($insert)
            return redirect()->route('contas.index')->with('success', "A conta {$request->conta} foi cadastrada com sucesso!");
        else
            return redirect()->route('contas.create')->with('error', "Houve um erro ao cadastrar a conta {$request->conta}.");
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
        $contas = Contas::all(['id', 'conta','operadora_id','observacao'])->sortBy('conta');
        $operadoras = Operadoras::all(['id', 'operadora'])->sortBy('operadora');

        $contas = $this->contas->find($id);
        return view('inventario.contas.edit', compact('contas','operadoras'));
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
        $contas  = $this->contas->find($id);
        $update   = $contas->update($dataForm);

        if ($update)
            return redirect()->route('contas.index')->with('success', "A conta {$contas->conta} foi atualizada com sucesso!");
        else
            return redirect()->route('contas.edit')->with('error', "Houve um erro ao editar a conta {$contas->conta}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contas = $this->contas->find($id);
        $delete = $contas->delete();

        if ($delete) {
            return redirect()->route('contas.index')->with('success', "A conta {$contas->conta} foi excluida com sucesso!");
        } else
            return redirect()->route('contas.index')->with('error', "Houve um erro ao excluir a conta {$contas->conta}.");
    }
}
