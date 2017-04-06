<?php

namespace App\Jobs;

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

        if ($travel->type = "attacking") {
            $this->underAttackNotification();
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
            dispatch(new AttackPlanet($this->travel->fleet, $this->travel->from_planet_id, $this->travel->to_planet_id));
        } else {
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
    }

}
