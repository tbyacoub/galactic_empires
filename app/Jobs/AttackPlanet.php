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
    private $attacker = [], $defender = [], $healthAtt = [], $healthDef = [];


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
        $this->attacker = $attackers;
        $this->attackingPlanetID = $attackID;
        $this->defendingPlanetID = $defendID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->returnShips(1000,1000,500);
    }


    private function returnShips($metal, $crystal, $energy)
    {
        $time = Travel::time(Planet::find($this->defendingPlanetID), Planet::find($this->attackingPlanetID));
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