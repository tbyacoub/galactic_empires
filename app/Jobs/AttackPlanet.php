<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

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
        $this->attackingPlanetID = $attackID;
        $this->defendingPlanetID = $deffendID;
        $this->attacker = $attackers; //form of [1,2,3,4,5] = 1 fighter, 2 bombers, etc
        $planet = \App\Planet::where('id', $this->defendingPlanetID)->first();
        $this->defender[0] = $planet->numFighters;
        $num = $this->defender[0];
        // echo "$num <-------------------\n";
        $this->defender[1] = $planet->numBombers;
        $this->defender[2] = $planet->numCorvettes;
        $this->defender[3] = $planet->numFrigates;
        $this->defender[4] = $planet->numDestroyers;
        for($i = 0; $i < 5; $i++)
        {
            $this->healthAtt[$i] = \App\Fleet::where('id', $i + 1)->first()->health;
            $this->healthDef[$i] = $this->healthAtt[$i];
            $health = $this->healthDef[$i];
            // echo "$health\n";
        }
        // echo "Finished __construct\n";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // echo "Starting handle\n";
        //three rounds to fight
        for($i = 0; $i < 3; $i++)
        {
            // echo "entering the loop and i = $i\n";
            // echo "-----------------------------------------------------\n";
            if($this->defeated())
            {
                break;
            }
            //each ship type attacks
            for($j = 0; $j < 5; $j++)
            {
                for($k = 0; $k < $this->attacker[$j]; $k++) //each ship in the fleet attacks
                {
                    if($this->attacker[$j] > 0)
                    {
                        $ship = \App\Fleet::where('id', $j+1)->first();
                        // echo "-------------------------------------\n";
                        // echo "ship is $ship->type\n";
                        $id = $this->findEnemy($ship);
                        $enemy = \App\Fleet::where('id', $id+1)->first();
                        // echo "enemy is $enemy->type\n";
                        $damage = ($ship->attack * $ship->multipliers[$enemy->type]) - $enemy->defence;
                        // echo "damage = $damage\n";
                        $health = $this->healthDef[$id];
                        // echo "health of enemy = $health\n";
                        if($damage > 0)
                        {
                            $this->healthDef[$id] = $this->healthDef[$id] - $damage; //defenders health is the prexisting health - damage done
                        }
                        $health = $this->healthDef[$id];
                        // echo "updated health of enemy = $health\n";
                        if($this->healthDef[$id] <= 0) //if health is <= 0 destroy the ship
                        {
                            // echo "destroying enemy ship\n";
                            $this->defender[$id] -= 1; 
                            if($this->defender[$id] > 0) //if there are still ships of that type left in the fleet reset health
                            {
                                $this->healthDef[$id] = \App\Fleet::where('id', $id + 1)->first()->health;
                                // echo "all enemy ships of this type destroyed\n";
                            }
                        }
                        if($this->defender[$id] > 0) //if the defender still has ships of this type remaining, attack back
                        {
                            // echo "attacking back\n";
                            $damage = ($enemy->attack * $enemy->multipliers[$ship->type]) - $ship->defence;
                            $this->healthAtt[$j] -= $damage;
                            if($this->healthAtt[$j] <= 0)
                            {
                                // echo "attacking ship destroyed\n";
                                $this->attacker[$j] -= 1;
                                if($this->attacker[$j] > 0)
                                {
                                    $this->healthAtt[$j] = \App\Fleet::where('id', $j + 1)->first()->health;
                                    // echo "all attacking ships of this type destroyed\n";
                                }
                            }
                        }
                    }
                }

            }
            // echo "end of the loop\n";
        }
        // echo "finished attack logic and starting travel\n";
        // echo "_______________________________________________________________\n";
        // echo "Travel Made\n";
        $metal = 0;
        $crystal = 0;
        $energy = 0;
        $pDeffend = \App\Planet::where('id', $this->defendingPlanetID)->first();
        $pAttack = \App\Planet::where('id', $this->attackingPlanetID)->first();
        if($this->defeated())
        {
            echo "Victory!!!!!!!!!!!!!!!!!!\n";
            $metal = $pDeffend->resources['metal'];
            $crystal = $pDeffend->resources['crystal'];
            $energy = $pDeffend->resources['energy'];
            echo "set resources\n";
            $pDeffend->setResources(($metal * 0.1), ($crystal * 0.1), ($energy * 0.1));
            $pDeffend->save();
            $metal *= 0.9;
            $crystal *= 0.9;
            $energy *= 0.9;
        }
        //update defending planets fleets
        // echo "pDeffend = $pDeffend->name\n";
        // echo "pAttack = $pAttack->name\n";
        // $num = $this->defender[0];
        // echo "Defenders have $num fighters left\n";
        $pDeffend->numFighters = $this->defender[0];
        $pDeffend->numBombers = $this->defender[1];
        $pDeffend->numCorvettes = $this->defender[2];
        $pDeffend->numFrigates = $this->defender[3];
        $pDeffend->numDestroyers = $this->defender[4];
        $pDeffend->save();
        //return attacking ships 
        echo "sending travel\n";
        $this->returnShips($pDeffend, $pAttack, $metal, $crystal, $energy);

        echo "finished travel\n";
    }

    private function defeated()
    {
        // echo "checking defeated\n";
        for($i = 0; $i < 5; $i++)
        {
            if($this->defender[$i] > 0)
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
            // echo "mult at $i = $mult\n";
            if($mult > $max && $this->defender[$i] > 0)
            {
                $max = $mult;
                $index = $i;
            }
            $i++;
        }
        // echo "returning index = $index\n";
        return $index;
    }

    private function returnShips($fromPlanet, $toPlanet, $metal, $crystal, $energy)
    {
        echo "starting returnShips\n";
        $travel = new \App\Travel();
        $travel->type = 'returning';
        echo "set return\n";
        $travel->from_planet_id = $this->defendingPlanetID;
        echo "set from id\n";
        $travel->to_planet_id = $this->attackingPlanetID;
        echo "set to id\n";
        $travel->fleet = $this->attacker;
        echo "set fleet\n";
        $travel->metal = $metal;
        echo "set metal\n";
        $travel->energy = $energy;
        echo "set energy\n";
        $travel->crystal = $crystal;
        echo "set crystal\n";
        $travel->departure = Carbon::now();
        echo "set departure\n";
        $travel->arrival = Carbon::now()->addMinutes($fromPlanet->calculateDistanceToOtherPlanet($toPlanet));
        echo "set arrival\n";
        $travel->save();

        dispatch((new TravelCompleted($travel))->delay(Carbon::now()->addMinutes($fromPlanet->calculateDistanceToOtherPlanet($toPlanet))));

        // TODO: Send notification to both players about the battle.

    }
}
