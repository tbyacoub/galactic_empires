<?php

namespace App\Jobs;

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
     * @return void
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
        echo time();
       $planets = \App\Planet::get();
       $global =  \App\GlobalRate::first();
       foreach ($planets as $planet)
       {
           $metal = $planet->metal();
           $crystal = $planet->crystal();
           $energy = $planet->energy();
           foreach($planet->resourcesBuildings() as $building)
           {
                $production = $building->product()->first();
                $bonus = $production->calculateBonus($building->getLevel());
                $metal += $production->calculateMetal($global->metal_rate);
                $crystal += $production->calculateCrystal($global->crystal_rate);
                $energy += $production->calculateEnergy($global->energy_rate);
           }
           $planet->setResources($metal, $crystal, $energy);
       }
    }

}
