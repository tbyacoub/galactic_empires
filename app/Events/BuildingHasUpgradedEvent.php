<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BuildingHasUpgradedEvent
{
    use InteractsWithSockets, SerializesModels;

    public $building_id;

    /**
     * Create a new event instance.
     *
     * @param $building_id
     *
     */
    public function __construct($building_id)
    {
        $this->building_id = $building_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('building.upgraded.' . $this->building_id);
//        return new PrivateChannel('channel-name');
    }
}
