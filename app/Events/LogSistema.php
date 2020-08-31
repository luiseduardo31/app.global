<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogSistema
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $user_id;
    private $acao;
    private $tabela;
    private $registro_id;
    private $grupo_id;
    private $retorno;
    

    public function __construct($user_id,$tipo_acao,$acao,$tabela,$registro_id,$grupo_id,$retorno)
    {
        $this->user_id = $user_id;
        $this->tipo_acao = $tipo_acao;
        $this->acao = $acao;
        $this->tabela = $tabela;
        $this->registro_id = $registro_id;
        $this->grupo_id = $grupo_id;
        $this->retorno = $retorno;
        
    }


    public function getUserId()
    {
        return $this->user_id;
    }

    public function getTipoAcao()
    {
        return $this->tipo_acao;
    }

    public function getAcao()
    {
        return $this->acao;
    }

    public function getTabela()
    {
        return $this->tabela;
    }
    
    public function getRegistroId()
    {
        return $this->registro_id;
    }

    public function getGrupoId()
    {
        return $this->grupo_id;
    }

    public function getRetorno()
    {
        return $this->retorno;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
