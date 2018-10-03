<?php

namespace App\Events;

use App\Token;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TokenWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Token
     *
     * @var \App\Token
     */
    public $token;

    /**
     * Create a new event instance.
     *
     * @param  \App\Token  $token
     * @return void
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('token-channel');
    }
}
