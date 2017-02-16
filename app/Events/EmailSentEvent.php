<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EmailSentEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user_id;

    public $mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $mail_id)
    {
        $this->user_id = $user_id;
        $this->mail = $mail_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('received.email.' . $this->user_id);
    }
}
