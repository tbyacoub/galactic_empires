<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $receiver;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * Sends a welcome mail to new users.
     *
     * @return void
     */
    public function handle()
    {
        $sender = \App\User::find(10);
        $mail = new \App\Mail([
            "subject" => "Welcome",
            "message" => "Welcome to galactic empires!",
            "read" => 0,
            "favorite" => 1,
        ]);
        $mail->sender()->associate($sender);
        $mail->receiver()->associate($this->receiver);
        $mail->save();
        event(new \App\Events\EmailSentEvent($this->receiver->id));
    }
}
