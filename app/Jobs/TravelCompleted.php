<?php

namespace App\Jobs;

use App\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TravelCompleted implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $travel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($travel)
    {
        $this->travel = $travel;

        if($travel->type = "attacking") {
            $notification = new Notification();
            $notification->sendAttackNotificationToDefender($travel);
        }

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->travel->travelIsComplete();

    }
}
