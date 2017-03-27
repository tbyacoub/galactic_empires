<?php

namespace App\Jobs;

use App\Notification;
use App\Travel;
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
    public function __construct(Travel $travel)
    {
        $this->travel = $travel;

        $notification = new Notification();
        $notification->sendAttackNotificationToDefender($travel);
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
