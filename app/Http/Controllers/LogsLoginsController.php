<?php

namespace App\Http\Controllers;

use App\Models\LogsLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogsLoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(LogsLogins $logslogins)
    {
        $this->logslogins = $logslogins;
        $this->middleware('auth');
        $this->middleware('check.permissions')->except([
            'index',
        ]);
    }  


    public function index(LogsLogins $logslogins)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $logslogins = DB::table('logs_logins')->orderBy('logsloginsID', 'ASC')
        ->select(array('logs_logins.id as logsloginsID', 'logs_logins.updated_at as logsloginsData', 'logs_logins.*', 'users.id', 'users.name', 'users.email'))
        ->join('users', 'users.id', '=', 'logs_logins.user_id')
        ->get();

        return view('logs.logs-logins', compact('logslogins'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logslogins = $this->logslogins->find($id);
        $delete = $logslogins->delete();

        $user_id = Auth::id();

        if ($delete) {

            return redirect()->route('logs-acessos.index')->with('success', "O registro de log {$logslogins->id} foi excluido com sucesso!");
        } else
            return redirect()->route('logs-acessos.show', $id);
    }
}
