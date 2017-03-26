<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttackPlanet implements ShouldQueue
{

    private $attackingPlanetID, $defendingPlanetID, $attacker = [], $defender = [], $healthAtt = [], $healthDef = [];



    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attackers, $attackID, $deffendID) //attckers will come in with travel->fleet, make a new travel back with the returning ships
    {
        $this->$attackingPlanetID = $attackID;
        $this->$defendingPlanetID = $deffendID;
        $this->$attacker = $attackers; //form of [1,2,3,4,5] = 1 fighter, 2 bombers, etc
        $planet = \App\Planet::where('id', $defendingPlanetID);
        $defender[0] = $planet->numfighters;
        $defender[1] = $planet->numBombers;
        $defender[2] = $planet->numCorvettes;
        $defender[3] = $planet->numFrigates;
        $defender[4] = $planet->numDestroyers;
        for($i = 0; $i < 5; $i++)
        {
            $healthAtt[$i] = App\Fleet::where('id', $i)->first()->health;
            $healthDef[$i] = $healthAtt[$i];
        }

        // $attacker = $attack->fleets()->get();
        // $defender = $defence->fleets()->get();
        // $i = 0;
        // foreach($attacker as $ship)
        // {
        //     healthAtt[$i++] = $ship->health;
        // }
        // $i = 0;
        // foreach($defender as $ship)
        // {
        //     healthDef[$i++] = $ship->health;
        // }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //three rounds to fight
        for($i = 0; $i < 3; $i++)
        {
            if(defeated())
            {
                break;
            }
            //each ship type attacks
            for($j = 0; $j < 5; $j++)
            {
                for($k = 0; $k < attacker[$j]; $k++) //each ship in the fleet attacks
                {
                    $ship = \App\Fleet::where('id', $j)->first();
                    $id = findEnemy($ship);
                    $enemy = \App\Fleet::where('id', $id);
                    $damage = ($ship->attack * $ship->multipliers[$enemy->name]) - $enemy->defence;
                    $healthDef[$id] = $healthDef[$id] - $damage; //defenders health is the prexisting health - damage done
                    if($healthDef[$id] <= 0) //if health is <= 0 destroy the ship
                    {
                        $defender[$id] -= 1; 
                        if($defender[$id] > 0) //if there are still ships of that type left in the fleet reset health
                        {
                            $healthDef[$id] = App\Fleet::where('id', $id)->first()->health;
                        }
                    }
                    if($defender[$id] > 0) //if the defender still has ships of this type remaining, attack back
                    {
                        $damage = ($enemy->attack * $enemy->multipliers[$ship->name]) - $ship->defence;
                        $healthAtt[$j] -= $damage;
                        if($healthAtt[$j] <= 0)
                        {
                            $attacker[$j] -= 1;
                        }
                    }
                }

            }
        }

        $travel = new Travel();
        $metal = 0;
        $crystal = 0;
        $energy = 0;
        if(defeated())
        {
            $pAttack = \App\Planet::where('id', 'attackingPlanetID');
            $pDeffend = \App\Planet::where('id','defendingPlanetID');
            $metal = $pDeffend->metal;
            $crystal = $pDeffend->crystal;
            $energy = $pDeffend->energy;
            $pDeffend->setResources(($metal * 0.1), ($crystal * 0.1), ($energy * 0.1));
            $metal *= 0.9;
            $crystal *= 0.9;
            $energy *= 0.9;
        }
    
        //update defending planets fleets
        $pDeffend->numfighters = $defender[0];
        $pDeffend->numBombers = $defender[1];
        $pDeffend->numCorvettes = $defender[2];
        $pDeffend->numFrigates = $defender[3];
        $pDeffend->numDestroyers = $defender[4];
        //return attacking ships 
        $travel->startTravel($pDeffend, $pAttack, $attacker, 'returning');

    }

    private function defeated()
    {
        for($i = 0; $i < 5; $i++)
        {
            if($defender[$i] != 0)
            {
                return false;
            }
        }
        return true;
    }

    private function findEnemy($ship)
    {
        $mults = $ship->multipliers;
        $i = 0;
        $index = 0;
        $max = 0.5;
        foreach($mults as $mult)
        {
            if($mult > $max && $defender[$i] > 0)
            {
                $max = $mult;
                $index = $i;
            }
        }
        return $index;
    }

}
