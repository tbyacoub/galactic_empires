<?php

namespace App\Jobs;

use App\Planet;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttackPlanet implements ShouldQueue
{

    private $attackingPlanetID;
    private $defendingPlanetID;
    private $defendingPlanet;
    private $attackingPlanet;
    private $attacker = [], $defender = [], $healthAtt = [], $healthDef = [];
    private $planetaryDefense = [];
    private $fleets = [];
    private $numRounds = 3;


    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param $attackers
     * @param $attackID
     * @param $defendID
     */
    public function __construct($attackers, $attackID, $defendID)
    {
        $this->attacker = $attackers; //incomming travel, will be array [1, 2, 3]
        $this->attackingPlanetID = $attackID; //id of attacking planet
        $this->defendingPlanetID = $defendID; //id of defending planet
        $this->defendingPlanet = Planet::find($this->defendingPlanetID); //defending planet
        $this->attackingPlanet = Planet::find($this->attackingPlanetID); //attacking planet
        $fleet = $this->defendingPlanet->fleets()->get();
        for($i = 0; $i < sizeof($fleet); $i++)
        {
            $this->defender[$i] = $fleet[$i]->count;
            $this->healthDef[$i] = $fleet[$i]->product()->first()->characteristics['health'];
            $this->healthAtt[$i] = $this->healthDef;
        }
        $this->planetaryDefense = $this->defendingPlanet->buildingsOfType('planetary_defense')->get();
        $this->$fleets = App\Fleets::get();
    }

    /**
     * Ships will defend the planet in space, if the attackers destroy
     * all defending ships, their planetary defences will provide one 
     * last line of defence. If the attacker has at least one surviving
     * ship, it will return to the attacking planet with 50% of the defending
     * planet's resources
     *
     * @return void
     */
    public function handle()
    {
        if($this->defendingPlanet->user_id != -1)
        {
            $this->enemyPlanet();
        }
        else
        {
            $this->emptyPlanet();
        }
       
    }

    private function enemyPlanet()
    {
         for($i = 0; $i < $numRounds; $i++) //three rounds of battle
        {
            if($this->success())
            {
                break;
            }
            for($j = 0; $j < sizeof($this->attacker); $j++) //each fleet attacks
            {
                for($k = 0; $k < $this->attacker[$j]; $j++) //each ship within the fleet attacks
                {
                    $ship = $this->attackingPlanet->fleets()->get()[$j];
                    $index = $this->findEnemy($ship); //find enemy returns the id of the fleet which the attacking ship has the largest damage multiplier against
                    $defence = $this->defendingPlanet->fleets()->get()[$index]; 
                    $damage = $this->calculateDamage($ship, $defence);
                    //Make sure to balance it so that every ship does damage to every other ship
                    $this->healthDef[$index] -= $damage; //$this->calculateDamage($ship, $defence);
                    if($this->healthDef[$index] <= 0) //if the ship is destroyed, decrease the count of the fleet
                    {
                        $this->defender[$index] -= 1;

                        if($this->defender[$index] > 0) //if the fleet still has ships remaining, increase the health
                        {
                            $this->healthDef[$index] = $fleets[$index]->product()->first()->characteristics['health'];
                        }
                    }                   

                    if($this->defender[$index] > 0) //the defending fleet attacks back, as long as it still has ships remaining
                    {
                        $this->healthAtt[$ship->id - 1] -= $this->calculateDamage($defence, $ship);
                        if($this->healthAtt[$ship->id - 1] <= 0) //damage logic is the same as above
                        {
                            $this->attacker[$ship->id - 1] -= 1;

                            if($this->attacker[$ship->id - 1] > 0)
                            {
                                $this->healthAtt[$ship->id - 1] = $fleets[$ship->id - 1]->product()->first()->characteristics['health'];
                            }
                        }
                    }
                }
            }
        }
        //end of attack loop logic
        $metal = 0;
        $crystal = 0;
        $energy = 0;
        if($this->success()) //defending planet loses 50% of their resources if the attack is successful
        {
            $metal = $this->defendingPlanet->metal() * 0.5; 
            $crystal = $this->defendingPlanet->crystal() * 0.5;
            $energy = $this->defendingPlanet->energy() * 0.5;
            $this->defendingPlanet->setResources($metal, $crystal, $energy); //THIS HAS TO CHANGE IF WE DO SOMETHING OTHER THAN 50%
        }

        $this->returnShips($metal, $crystal, $energy); //return ships to the attacking planet with any resources gained
        $this->defendingPlanet->fleets();
    }

    private function emptyPlanet()
    {

    }


    private function returnShips($metal, $crystal, $energy)
    {
        $time = Travel::time($this->defendingPlanet, $this->attackingPlanet);
        $travel = new Travel([
            'type' => 'returning',
            'from_planet_id' => $this->defendingPlanetID,
            'to_planet_id' => $this->attackingPlanetID,
            'fleet' => $this->attacker,
            'departure' => Carbon::now(),
            'arrival' => Carbon::now()->addMinutes($time),
            'metal' => $metal,
            'crystal' => $crystal,
            'energy' => $energy,
        ]);
        $travel->save();

        dispatch((new TravelCompleted($travel))->delay(Carbon::now()->addMinutes($time)));

    }
}