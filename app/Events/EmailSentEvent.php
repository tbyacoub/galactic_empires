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

    public $subject;

    public $sender;

    public $created_at;

    private $receiver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mail, $sender, $receiver)
    {
        $this->subject = $mail->subject;
        $this->sender = $sender->name;
        $this->created_at = $mail->getCreatedAt();
        $this->receiver = $receiver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('received.email.' . $this->receiver->id);
    }
}
