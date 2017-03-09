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
       $bonus = 1;
       $global =  \App\GlobalRate::first();
       foreach ($planets as $planet)
       {
          // echo $planet->name;
           $metal = $planet->metal();
           $crystal = $planet->crystal();
           $energy = $planet->energy();
           $buildings = $planet->buildings()->get();
           foreach($buildings as $building) 
           {
              $resources = $building->products()->where('producible_type', 'App\Building')->get();
              foreach ($resources as $resourceBuilding)
              {
                $bonus = (1 + (0.25 * (1 - $resourceBuilding->current_level)));  //calculate production rate bonus as a function of current level and global miltiplier, divide by 12 to convert hourly rate to every 5 minutes
                $metal += (($resourceBuilding->characteristics['metal_base_rate']) * $bonus * $global->mineral_rate) / 12;
                $crystal += (($resourceBuilding->characteristics['crystal_base_rate']) * $bonus * $global->crystal_rate) / 12;
                $energy += (($resourceBuilding->characteristics['energy_base_rate']) * $bonus * $global->energy_rate) / 12;
              }
              $planet->resources = [
                    'metal' => ceil($metal),
                    'crystal' => ceil($crystal),
                    'energy' => ceil($energy)
              ];
              $planet->save();
           }
       }   
    }
       
}