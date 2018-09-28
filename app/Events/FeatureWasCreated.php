<?php

namespace App\Events;

use App\Feature;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FeatureWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Feature
     *
     * @var \App\Feature
     */
    public $feature;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Feature  $feature
     * @return void
     */
    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('feature-channel');
    }
}