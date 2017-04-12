<?php

namespace App\Jobs;

use App\Events\NotificationReceivedEvent;
use App\Events\TravelStatusChangedEvent;
use App\Notification;
use App\Planet;
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
     * @param $travel
     */
    public function __construct($travel)
    {
        $this->travel = $travel;

        if ($travel->type == "attacking") {
            event(new TravelStatusChangedEvent($this->travel->toPlanet()->first()->user()->first()->id));
            $this->underAttackNotification();
        } else {
            event(new TravelStatusChangedEvent($this->travel->toPlanet()->first()->user()->first()->id));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->travel->type == 'attacking') {
            event(new TravelStatusChangedEvent($this->travel->fromPlanet()->first()->user()->first()->id));
            event(new TravelStatusChangedEvent($this->travel->toPlanet()->first()->user()->first()->id));
            dispatch(new AttackPlanet($this->travel->fleet, $this->travel->from_planet_id, $this->travel->to_planet_id));
        } else {
            event(new TravelStatusChangedEvent($this->travel->toPlanet()->first()->user()->first()->id));
            $planet = Planet::find($this->travel->to_planet_id);
            $fleets = $planet->fleets()->get();

            for ($i = 0; $i < count($fleets); $i++) {
                $fleet = $fleets[$i];
                $fleet->count = $fleet->count + intVal($this->travel->fleet[$i]);
                $fleet->save();
            }

            $planet->setResources($planet->metal() + $this->travel->metal,
                $planet->crystal() + $this->travel->crystal,
                $planet->energy() + $this->travel->energy);

            $this->fleetReturnedNotification();
        }

        $this->travel->delete();
    }

    private function underAttackNotification()
    {
        $notification = new Notification();
        $notification->subject = "You're are under attack.";
        $notification->content = $this->travel->fromPlanet()->first()->user()->first()->name . ' has Launched an Attack'
            . ' on ' . $this->travel->toPlanet()->first()->name . '. Go to home page to view the status.';
        $notification->read = false;
        $notification->user()->associate($this->travel->toPlanet()->first()->user()->first()->id);
        $notification->save();

        echo "attacking fleet notification.\n";
        event(new NotificationReceivedEvent($this->travel->toPlanet()->first()->user()->first()->id));
    }

    private function fleetReturnedNotification()
    {
        $notification = new Notification();
        $notification->subject = "You're fleet has returned to " . $this->travel->toPlanet()->first()->name . '.';
        $notification->content = "Returned from Planet " . $this->travel->fromPlanet()->first()->name . ". \n"
            . 'Your attack has gained ' . $this->travel->metal . ' Metal, ' . $this->travel->crystal
            . ' Crystal and ' . $this->travel->energy . ' Energy.';
        $notification->read = false;
        $notification->user()->associate($this->travel->toPlanet()->first()->user()->first()->id);
        $notification->save();

        echo "returning fleet notification.\n";
        event(new NotificationReceivedEvent($this->travel->toPlanet()->first()->user()->first()->id));
    }

}
