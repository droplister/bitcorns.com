<?php

namespace App\Events;

use App\Farm;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FarmWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Farm
     *
     * @var \App\Farm
     */
    public $farm;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Farm  $farm
     * @return void
     */
    public function __construct(Farm $farm)
    {
        $this->farm = $farm;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('farm-channel');
    }
}