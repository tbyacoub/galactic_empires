<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttackPlanet implements ShouldQueue
{

    private $attacker, $defender, $healthAtt = [], $healthDef = [];



    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Planet $attack, Planet $defence)
    {
        $attacker = $attack->fleets()->get();
        $defender = $defence->fleets()->get();
        $i = 0;
        foreach($attacker as $ship)
        {
            healthAtt[$i++] = $ship->health;
        }
        $i = 0;
        foreach($defender as $ship)
        {
            healthDef[$i++] = $ship->health;
        }
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
            if (sizeof($defender) == 0)
            {
               break;
            }
            attack($this->$attacker, $this->$defender);
            attack($this->$defender, $this->$attacker);
        }
        if (sizeof($defender) == 0)
        {
           success();
        }
        else
        {
            failure();
        }

    }


    public function attack($attack, $defend)
    {
        foreach($attack as $ship)
        {
            $type = $defend->first()->type;
            $mult = $ship->multipliers[$type];
            foreach($defend as $defShip)
            {
                if($mult < $ship->multipliers[$type])
                {
                    $mult = $ship->multipliers[$type];
                    $type = $ship->type;
                }
            }
            $def = $defend->fleets()->get()->where('type', $type);
            $damage = $def->defence - ($ship->attack * $mult); //switch this so it's positive
            $def->health = $def->health - $damage;
            if($def->health <= 0)
            {
                destroyShip($def);
            }
        }
    }
    //Attacker gets 90% of defenders resources
    //Attackers ships go back to their planet
    public function success()
    {
        returnShips();
        $pdefender = $defender->planet();
        $pattacker = $attacker->planet();
        $metal = $pdefender->metal() * 0.9;
        $crystal = $pdefender->crystal() * 0.9;
        $energy = $pdefender->energy() * 0.9;
        $pdefender->setResources(($metal / 9), ($crystal / 9), ($energy / 9));
        $metal += $pattacker->metal();
        $crystal += $pattacker->crystal();
        $energy += $patacker->energy();
        $pattacker->setResources($metal, $crystal, $energy);   
    }

    //Defender gets 10% of attacker's resources
    //Attackers ships go back to their planet
    public function failure()
    {
        returnShips();
        $pdefender = $defender->planet();
        $dattacker = $attacker->planet();
        $metal = $pattacker->metal() * 0.9;
        $crystal = $pattacker->crystal() * 0.9;
        $energy = $pattacker->energy() * 0.9;
        $pattacker->setResources($metal, $crystal, $energy);
        $metal = ($metal/9) + $pdefender->metal();
        $crystal += ($crystal/9) + $pdefender->crystal();
        $energy += ($energy / 9) + $pdefender->energy();
        $pdefender->setResources($metal, $crystal, $energy);  
    }

    public function returnShips()
    {
        //TODO
    }

    public function destroyShip($ship)
    {
        //TODO
    }

}
