<?php

namespace App;

use App\Jobs\AttackPlanet;
use App\Jobs\TravelCompleted;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'from_planet_id', 'to_planet_id', 'fleet', 'destination_timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * By default, timestamps are formatted as 'Y-m-d H:i:s'
     *
     * @var array
     */
    protected $dates = [
        'departure', 'arrival'
    ] ;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fleet' => 'array',
    ];

    /**
     * Get the origin planet of this Travel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fromPlanet(){
        return $this->hasOne('App\Planet', 'id', 'from_planet_id');
    }

    /**
     * Get the destination planet of this Travel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toPlanet(){
        return $this->hasOne('App\Planet', 'id', 'to_planet_id');
    }

    public function setResources($metal, $crystal, $energy){
        $this->metal = $metal;
        $this->crystal = $crystal;
        $this->energy = $energy;
    }

    /**
     * @return double percent to reach destination (0 - 100)
     */
    public function getTravelPercent(){
        $current = Carbon::now()->timestamp - $this->departure->timestamp;
        $difference = $this->arrival->timestamp - $this->departure->timestamp;
        if($difference == 0) {
            $difference = 1;
        }
        return 100 * ($current / $difference);
    }

    /**
     * Get the percent rate per second that this fleet is Traveling at.
     *
     * @return float|int
     */
    public function getPercentRatePerSecond(){
        $difference = $this->arrival->timestamp - $this->departure->timestamp;
        if($difference == 0) {
            $difference = 1;
        }
        return 100 / $difference;
    }

    /**
     * Run on TravelCompleted Job.
     */
    public function travelIsComplete(){
        if($this->type == 'attacking'){
            $travel = new Travel();
            $travel->type = "returning";
            $travel->from_planet_id = $this->to_planet_id;
            $travel->to_planet_id = $this->from_planet_id;
            $travel->fleet = $this->fleet;
            $travel->departure = Carbon::now();
            $travel->arrival = Carbon::now()->addMinutes($this->fromPlanet($this->to_planet_id)->first()->calculateDistanceToOtherPlanet($this->fromPlanet($this->from_planet_id)->first()));
            $travel->save();
            dispatch((new TravelCompleted($travel))->delay(Carbon::now()->addMinutes($this->fromPlanet($this->to_planet_id)->first()->calculateDistanceToOtherPlanet($this->fromPlanet($this->from_planet_id)->first()))));
            $this->delete();
        }else if($this->type == 'returning') {
            // Return fleet to Planet
            $this->toPlanet()->first()->addShipsToPlanetFleet($this->fleet);

            // Add resources won from battle.
//            $this->toPlanet()->first()->setResources($this->metal, $this->crystal, $this->energy);
            $this->delete();

            // Notify that fleet has returned.
            $notification = new Notification();
            $notification->sendFleetHasReturnedNotification($this);
        }
    }


}