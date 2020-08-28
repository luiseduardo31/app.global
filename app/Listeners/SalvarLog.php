<?php

namespace App\Listeners;

use App\Events\LogSistema;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Logs;

class SalvarLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  LogSistema  $event
     * @return void
     */
    public function handle(LogSistema $event)
    {
        $user = Auth::user();
        $user_id = Auth::id();

        $acao = $event->getAcao();
        $acao_id = $event->getAcaoID();
        $user_id = $event->getUserID();
        $data = ['acao'=>$acao, 'tabela'=>$acao_id, 'user_id'=>$user_id];

        DB::table('logs')->insert($data);
        
        file_put_contents(storage_path()."/event.txt",$data);

        
    }
}
