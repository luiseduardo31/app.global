<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{

    public function __construct(Logs $logs)
    {
        $this->logs = $logs;
        $this->middleware('auth');
        $this->middleware('check.permissions')->except([
            'index',
        ]);
    }    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Logs $logs)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $logs = DB::table('logs')
            ->select(array('logs.id as logsID','logs.updated_at as LogsData','logs.*', 'users.id','users.name','users.email','grupos_users.*', 'grupos.*'))
            ->join('users', 'users.id', '=', 'logs.user_id')
            ->join('grupos', 'grupos.id', '=', 'logs.grupo_id')
            ->join('grupos_users', 'grupos_users.grupos_id', '=', 'logs.grupo_id')
            ->where('users_id', $user_id)
            ->get();

        return view('logs.index', compact('logs'));
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
     * @param  \App\models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function show(Logs $logs)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function edit(Logs $logs)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logs $logs)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logs = $this->logs->find($id);
        $delete = $logs->delete();

        $user_id = Auth::id();

        if ($delete) {

            return redirect()->route('logs.index')->with('success', "O registro de log {$logs->id} foi excluido com sucesso!");
        } else
            return redirect()->route('logs.show', $id);
    }
}
