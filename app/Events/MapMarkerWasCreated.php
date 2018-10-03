<?php

namespace App\Events;

use App\MapMarker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MapMarkerWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * MapMarker
     *
     * @var \App\MapMarker
     */
    public $map_marker;

    /**
     * Create a new event instance.
     *
     * @param  \App\MapMarker  $map_marker
     * @return void
     */
    public function __construct(MapMarker $map_marker)
    {
        $this->map_marker = $map_marker;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('map-marker-channel');
    }
}
