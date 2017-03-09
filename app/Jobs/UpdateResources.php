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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $planets = \App\Planet::get();
       $bonus = 1;
       $global =  \App\GlobalRate::first();
       foreach ($planets as $planet)
       {
          // echo $planet->name;
           $metal = $planet->metal();
           $crystal = $planet->crystal();
           $energy = $planet->energy();
           $buildings = $planet->resourcesBuildings();
           foreach($buildings as $building)
           {
                $resource = $building->product();
                $bonus = (1 + (0.25 * (1 - $building->getLevel())));  //calculate production rate bonus as a function of current level and global miltiplier, divide by 12 to convert hourly rate to every 5 minutes
                $metal += (($resource->characteristics['metal_base_rate']) * $bonus * $global->mineral_rate) / 12;
                $crystal += (($resource->characteristics['crystal_base_rate']) * $bonus * $global->crystal_rate) / 12;
                $energy += (($resource->characteristics['energy_base_rate']) * $bonus * $global->energy_rate) / 12;
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
