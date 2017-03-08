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
    public function __construct(Planet $planet, User $user)
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
        $user = Auth::user;
        $global_multiplier = 1; //make this pull from the DB table
        $delta = 5;
       $planets = App\Planet::where('user_id', $user->id);
       foreach ($planets as $planet)
       {
           $buildings = $planet->buildings()->producible()->where('producible_type', 'resources'); //grab all of the resource buildings
           foreach($buildings as $resourceBuilding) //probably use building planet instead
           {
               $bonus = (1 + (0.25 * (1 - $resourceBuilding->current_level))); // times global_multiplier 
               // $bonus = $resourceBuilding->current_level;
               // $bonus = 2;
               $metal = (($resourceBuilding->characteristics->metal_base_rate) * $bonus);
               $planet->metal()->update((($resourceBuilding->characteristics->metal_base_rate) * $bonus));
               $planet->cyrstal()->update((($resourceBuilding->characteristics->crystal_base_rate) * $bonus));
               $planet->energy()->update((($resourceBuilding->characteristics->energy_base_rate) * $bonus));
           }
       }
        // $planet = App\Planet::where('user_id', $user->id)->first();
        // $planet->metal()->update(0);
        // $building = $planet->buildings()->producible()->where('producible_type', 'resources')->first();
        // $metal = (($building->characteristics->metal_base_rate) * 2);
        // return $metal;
        
    }
}


/*
*Every 5 minutes every user gets all of their resources updated for every building on every planet
*/