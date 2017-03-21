<?php

namespace App\Jobs;

use App\User;
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
     * @param $receiver
     */
    public function __construct(User $receiver)
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
        $sender = \App\User::where('name', '=', 'admin')->first();
        $mail = new \App\Mail([
            "subject" => "Welcome ". $this->receiver->name,
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
