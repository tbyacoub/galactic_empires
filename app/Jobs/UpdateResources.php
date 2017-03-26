<?php

namespace App\Jobs;

use App\Events\ResourceUpdatedEvent;
use App\GlobalRate;
use App\Planet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class UpdateResources implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Updates resources on all planets every five minutes
     * Uses base production rate for each resource building scaled by level
     *
     * @return void
     */
    public function handle()
    {
       $planets = Planet::get();
       $global =  GlobalRate::first();
       foreach ($planets as $planet)
       {
           $metal = $planet->metal();
           $crystal = $planet->crystal();
           $energy = $planet->energy();
           foreach($planet->buildingsOfType('resource')->get() as $building)
           {
                $production = $building->product()->first();
                $production->calculateBonus($building->getLevel());
                $metal += $production->calculateMetal($global->metal_rate);
                $crystal += $production->calculateCrystal($global->crystal_rate);
                $energy += $production->calculateEnergy($global->energy_rate);
           }
           $planet->setResources($metal, $crystal, $energy);
       }
       event(new ResourceUpdatedEvent());
    }

}
