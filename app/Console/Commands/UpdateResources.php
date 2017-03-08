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
       $planets = \App\Planet::all();
       $rate = 5;
       $global_multiplier = 1;
       foreach ($planets as $planet)
       {
           // $buildings = $planet->buildings()->products()->where('producible_type', 'resources'); //grab all of the resource buildings
           $buildings = $planet->buildings()->where('producible_type', 'resources');
           foreach($buildings as $resourceBuilding) //probably use building planet instead
           {
               $bonus = (1 + (0.25 * (1 - $resourceBuilding->pivot->current_level))) * $global_multiplier; // times global_multiplier 
               // $bonus = $resourceBuilding->current_level;
               // $bonus = 2;
               $metal = $planet->metal() + (($resourceBuilding->characteristics->metal_base_rate) * $bonus);
               $planet->metal()->update((($resourceBuilding->characteristics->metal_base_rate) * $bonus));
               $planet->cyrstal()->update((($resourceBuilding->characteristics->crystal_base_rate) * $bonus));
               $planet->energy()->update((($resourceBuilding->characteristics->energy_base_rate) * $bonus));
           }
       }
    }
}


