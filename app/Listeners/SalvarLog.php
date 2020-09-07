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

        $user_id = $event->getUserId();
        $tipo_acao = $event->getTipoAcao();
        $acao = $event->getAcao();
        $tabela = $event->getTabela();
        $registro_id = $event->getRegistroId();
        $grupo_id = $event->getGrupoId();
        $retorno = $event->getRetorno();
        $data = ['user_id' => $user_id,'tipo_acao' => $tipo_acao,'acao'=>$acao, 'tabela'=>$tabela, 'registro_id'=>$registro_id,'grupo_id'=>$grupo_id,'retorno'=>$retorno];

        DB::table('logs')->insert($data);
        
        #file_put_contents(storage_path() . "/event.txt", $data);        
    }
}
