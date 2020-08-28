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
    private $acao;
    private $acao_id;
    private $user_id;

    public function __construct($acao,$acao_id,$user_id)
    {
        $this->acao = $acao;
        $this->acao_id = $acao_id;
        $this->user_id = $user_id;
    }

    public function getAcao()
    {
        return $this->acao;
    }

    public function getAcaoID()
    {
        return $this->acao_id;
    }

    public function getUserID()
    {
        return $this->user_id;
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
