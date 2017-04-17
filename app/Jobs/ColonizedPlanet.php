<?php

namespace App\Jobs;

use App\Events\NotificationReceivedEvent;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ColonizedPlanet implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $colonization;
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($colonization, $user, $time)
    {
        $this->colonization = $colonization;
        $this->user = $user;

        //Send initial Notification
        $notification = new Notification();
        $notification->subject = "Planet Colonization.";
        $notification->content = $colonization->planet()->first()->name . " will now begin to be colonized. You" .
                                    " will receive a notification when this is complete. Estimated completion: " .
                                    Carbon::now()->addMinutes($time)->diffForHumans();
        $notification->read = false;
        $notification->user()->associate($this->user->id);
        $notification->save();

        event(new NotificationReceivedEvent($this->user->id));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $planet = $this->colonization->planet()->first();
        $planet->user_id = $this->user->id;
        $planet->save();

        $this->colonization->delete();

        // Send notification of Colonization complete.
        $notification = new Notification();
        $notification->subject = "Planet Colonization Complete.";
        $notification->content = "You have successfully colonized a new planet. " . $this->colonization->planet()->first()->name
                                . " is now available for you to upgrade, research, and create new fleets.";
        $notification->read = false;
        $notification->user()->associate($this->user->id);
        $notification->save();

        event(new NotificationReceivedEvent($this->user->id));
    }
}
