<?php

namespace App\Console\Commands;

use Activity;
use Illuminate\Console\Command;

class UpdateResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $planets = \App\Planet::get();
       $global_multiplier = 1;
       $bonus = 1;
       foreach ($planets as $planet)
       {
          // echo $planet->name;
           $metal = $planet->metal();
           $crystal = $planet->crystal();
           $energy = $planet->energy();
           $buildings = $planet->buildings();
           foreach($buildings as $building) 
           {
              // $resources = $building->products()->where('producible_type', 'App\Building')->get();
            if($building->producible_type == 'App\Building')
            {
               $metal += (($building->characteristics['metal_base_rate']) * $bonus);
               $crystal += (($building->characteristics['crystal_base_rate']) * $bonus);
               $energy += (($building->characteristics['energy_base_rate']) * $bonus);
            }
              foreach ($resources as $resourceBuilding)
              {
                // $bonus = (1 + (0.25 * (1 - $resourceBuilding->current_level))) * $global_multiplier;  //calculate production rate bonus as a function of current level and global miltiplier
                $metal += (($resourceBuilding->characteristics['metal_base_rate']) * $bonus);
                $crystal += (($resourceBuilding->characteristics['crystal_base_rate']) * $bonus);
                $energy += (($resourceBuilding->characteristics['energy_base_rate']) * $bonus);
              }
              $planet->resources = [
                    'metal' => 5,
                    'crystal' => 5,
                    'energy' => 5
              ];
           }
          //  $planet->resources = [
          //         'metal' => $metal,
          //         'crystal' => $crystal,
          //         'energy' => $energy
          //       ];
          // $planet->save();
       }
    }
}


