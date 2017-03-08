<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BuildingHasUpgradedEvent
implements ShouldBroadcast{
    use InteractsWithSockets, SerializesModels;

    public $user_id;

    /**
     * Create a new event instance.
     *
      * @param $user_id
     */
    public function __construct($id)
    {
        $this->user_id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('building.upgraded.' . $this->user_id );
    }
}
