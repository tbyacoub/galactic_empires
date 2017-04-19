<?php

namespace App\Jobs;

use App\Events\NotificationReceivedEvent;
use App\Notification;
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
    private $fleets = [];
    private $planetaryDefense = [];
    private $numRounds = 3;
    private $attackerWon = false;


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
        // echo "it worked\n";
        $this->attacker = $attackers; //incomming travel, will be array [1, 2, 3]
        // echo "attackers set\n";
        $this->attackingPlanetID = $attackID; //id of attacking planet
        $this->defendingPlanetID = $defendID; //id of defending planet
        // echo "planet ID's set\n";
        $this->defendingPlanet = \App\Planet::find($this->defendingPlanetID); //defending planet
        $this->attackingPlanet = \App\Planet::find($this->attackingPlanetID); //attacking planet
        // echo "planets set\n";
        $this->fleets = $this->defendingPlanet->fleets()->get();
        // echo "temp fleet set\n";
        for($i = 0; $i < sizeof($this->fleets); $i++)
        {
            $this->defender[$i] = $this->fleets[$i]->count;
            $this->healthDef[$i] = $this->fleets[$i]->product()->first()->characteristics['health'];
            $this->healthAtt[$i] = $this->healthDef[$i];
        }
        // echo "fleet and health arrays set\n";
        $this->planetaryDefense = $this->defendingPlanet->buildingsOfType('planetary_defense')->get();
        // echo "planetary defenses set\n";
        // $this->handle();
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
        // echo "handling?\n";
        if($this->defendingPlanet->user_id != -1)
        {
            echo "attacking an enemy planet\n";
            $this->enemyPlanet();
        }
        else
        {
            echo "attacking an empty planet\n";
            $this->emptyPlanet();
        }
       
    }

    private function enemyPlanet()
    {
         for($i = 0; $i < $this->numRounds; $i++) //three rounds of battle
        {
            echo "_________________________________________________________________________________\n";
            echo "starting round $i\n";
            echo "_________________________________________________________________________________\n";
            for($j = 0; $j < sizeof($this->attacker); $j++) //each fleet attacks
            {
                for($k = 0; $k < $this->attacker[$j]; $k++) //each ship within the fleet attacks
                {

                    if($this->destroyed($this->defender) || $this->destroyed($this->attacker))
                    {
                        echo "breaking the loop\n";
                        break;
                    }

                    if($this->attacker[$j] > 0) //make sure the fleet is actually available
                    {
                        echo "_________________________________________________________________________________\n";
                        $ship = $this->attackingPlanet->fleets()->get()[$j];
                        $index = $this->findEnemy($ship); //find enemy returns the id of the fleet which the attacking ship has the largest damage multiplier against
                        echo "index = $index\n";
                        $defence = $this->defendingPlanet->fleets()->get()[$index]; 
                        $t1 = $ship->description()->first()->name;
                        $t2 = $defence->description()->first()->name;
                        echo "$t1 attacking $t2\n";
                        $damage = $this->calculateDamage($ship, $defence);
                        echo " causing $damage damage\n";
                        //Make sure to balance it so that every ship does damage to every other ship
                        $this->healthDef[$index] -= $damage; //$this->calculateDamage($ship, $defence);
                        $t3 = $this->healthDef[$index];
                        echo "$t3 health remaining\n";
                        if($this->healthDef[$index] <= 0) //if the ship is destroyed, decrease the count of the fleet
                        {
                            $this->defender[$index] -= 1;
                            echo "defender's $t2 destroyed<---------------\n";

                            if($this->defender[$index] > 0) //if the fleet still has ships remaining, increase the health
                            {
                                $this->healthDef[$index] = $this->fleets[$index]->product()->first()->characteristics['health'];
                                echo "one of defender's $t2's destroyed\n";
                            }
                            else
                            {
                                echo "all of defender's $t2's destroyed\n";
                            }
                        }                   
                        echo "_________________________________________________________________________________\n";
                        if($this->defender[$index] > 0) //the defending fleet attacks back, as long as it still has ships remaining
                        {
                            echo "$t2 is attacking $t1 back\n";
                            $damage = $this->calculateDamage($defence, $ship);
                            echo "damage = $damage\n";
                            $this->healthAtt[$j] -= $damage;
                            $t3 = $this->healthAtt[$j];
                            echo "$t3 health remaining\n";
                            if($this->healthAtt[$j] <= 0) //damage logic is the same as above
                            {
                                echo "attackers $t1 destroyed<--------------------\n";
                                $this->attacker[$j] -= 1;

                                if($this->attacker[$j] > 0)
                                {
                                    echo "one of attacker's $t1's destroyed\n";
                                    $this->healthAtt[$j] = $this->fleets[$j]->product()->first()->characteristics['health'];
                                }
                                else
                                {
                                    echo "all of attacker's $t1's destroyed\n";
                                }
                            }
                        }
                    }
                }
            }
            echo "planetary defences attacking\n";
            $this->planetaryDefense(); //planetary defense attacks at the end of each round
        }
        //end of attack loop logic
        $metal = 0;
        $crystal = 0;
        $energy = 0;
        if($this->success()) //defending planet loses 50% of their resources if the attack is successful
        {
            echo "VICTORY\n";
            $this->attackerWon = true;
            $metal = $this->defendingPlanet->metal() * 0.5; 
            $crystal = $this->defendingPlanet->crystal() * 0.5;
            $energy = $this->defendingPlanet->energy() * 0.5;
            $this->defendingPlanet->setResources($metal, $crystal, $energy); //THIS HAS TO CHANGE IF WE DO SOMETHING OTHER THAN 50%
        }
        else
        {
            echo "DEFEAT\n";
        }

        $this->returnShips($metal, $crystal, $energy); //return ships to the attacking planet with any resources gained
        for($i = 0; $i < sizeof($this->defender); $i++)
        {
            $fleet = $this->defendingPlanet->fleets()->get()[$i];
            $name = $fleet->description()->first()->name;
            if($this->defender[$i] >= 0)
            {
                $fleet->count = $this->defender[$i];
            }
            else
            {
                $fleet->count = 0;
            }
            echo "updating defending $name to $fleet->count\n";
            $fleet->save();
        }
        $this->defendingPlanet->save();
    }

    private function emptyPlanet()
    {

    }

    /*
    * Planetary defenses attack the invading ships. Each of the planets defenses will attack
    * a random fleet. There is no check whether or not the fleet has any ships in it, therefore
    * the defenses have a chance to miss
    */
    private function planetaryDefense()
    {
        $index = mt_rand(0, (sizeof($this->attacker) - 1));
        foreach($this->planetaryDefense as $defense)
        {
            if($this->attacker[$index] > 0)
            {
                echo "index = $index\n";
                $name = $defense->description()->first()->name;
                echo "defending with $name\n";
                $this->healthAtt[$index] -= ($defense->product()->first()->characteristics['base_attack']) * (1 + (0.25 * ($defense->current_level - 1)));
                if($this->healthAtt[$index] <= 0)
                {
                    $this->attacker[$index] -= 1;
                    if($this->attacker[$index] == 0)
                    {
                        $index = mt_rand(0, (sizeof($this->attacker) - 1));
                    }
                }
            }
        }

    }

    /*
     * If all of the defending ships are destroyed, and there is at least one attacking ship
     * remaining, the attack is successful
     */ 
    private function success()
    {
        $val = ($this->destroyed($this->defender) && !$this->destroyed($this->attacker));
        echo "success is returning: $val ______________________________________\n";
        return ($this->destroyed($this->defender) && !$this->destroyed($this->attacker));
    }

    private function destroyed($fleets)
    {
        echo "checking destroyed\n";
        for($i = 0; $i < sizeof($fleets); $i++)
        {
            if($fleets[$i] > 0)
            {
                echo "destroyed is returning false at fleets[$i]\n";
                return false;
            }
        }
        echo "destroyed is returning true\n";
        return true;
    }

    private function findEnemy($fleet)
    {
        echo "finding enemy\n";
        $mults = $fleet->product()->first()->characteristics['multipliers'];
        $index = 0;
        $max = 0.5;
        $i = 0;
        foreach($mults as $mult)
        {
            echo "mult = $mult\n";
            if(($mult > $max) && ($this->defender[$i] > 0))
            {
                $index = $i;
                $max = $mult;
            }

            $i++;
        }
        echo "returning index = $index\n";
        return $index;
    }

    private function calculateDamage($attacking, $defending)
    {
        $damage = $attacking->product()->first()->characteristics['attack'];
        echo "initial damage = $damage\n";
        $damage *= $attacking->product()->first()->characteristics['multipliers'][$defending->description()->first()->name];
        echo "damage after multiplier = $damage\n";
        $damage -= $defending->product()->first()->characteristics['defense'];
        echo "returning damage = $damage\n";
        return $damage;
    }

    private function returnShips($metal, $crystal, $energy)
    {
        if($this->attackerWon) {
            $this->won($this->attackingPlanet->user()->first()->id);
            $this->lost($this->defendingPlanet->user()->first()->id);
        } else {
            $this->lost($this->attackingPlanet->user()->first()->id);
            $this->won($this->defendingPlanet->user()->first()->id);
        }

        foreach($this->attacker as $fleet)
        {
            if($fleet < 0)
            {
                $fleet = 0;
            }
        }
        echo "starting travel\n";
        $time = \App\Travel::time($this->defendingPlanet, $this->attackingPlanet);
        $travel = new \App\Travel([
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
        echo "travel sent\n";

    }

    private function lost($user_id){
        $notification = new Notification([
            "subject" => "Battle Completed.",
            "content" => "You have lost the battle.",
            "read" => false,
        ]);
        $notification->user()->associate($user_id);
        $notification->save();
        event(new NotificationReceivedEvent($user_id));
    }

    private function won($user_id) {
        $notification = new Notification([
            "subject" => "Battle Completed.",
            "content" => "You have won the battle.",
            "read" => false,
        ]);
        $notification->user()->associate($user_id);
        $notification->save();
        event(new NotificationReceivedEvent($user_id));
    }
}