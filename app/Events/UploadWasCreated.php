<?php

namespace App\Events;

use App\Upload;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UploadWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Upload
     *
     * @var \App\Upload
     */
    public $upload;

    /**
     * Create a new event instance.
     *
     * @param  \App\Upload  $upload
     * @return void
     */
    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('upload-channel');
    }
}
