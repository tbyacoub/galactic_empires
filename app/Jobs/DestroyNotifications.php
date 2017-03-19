<?php

namespace App\Jobs;

use App\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DestroyNotifications implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $notifications;

    /**
     * Create a new job instance.
     *
     * @param $notifications
     */
    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->notifications as $notification){
            $notification->delete();
        }
    }
}
