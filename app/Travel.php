<?php

namespace App;

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
        return 100 * ($current / $difference);
    }

    /**
     * Get the percent rate per second that this fleet is Traveling at.
     *
     * @return float|int
     */
    public function getPercentRatePerSecond(){
        $difference = $this->arrival->timestamp - $this->departure->timestamp;
        return 100 / $difference;
    }

    /**
     * @param Planet $from_planet
     * @param Planet $to_planet
     * @param $fleet
     */
    public function startTravel(Planet $from_planet, Planet $to_planet, $fleet, $type){
        $this->type = $type;
        $this->from_planet_id = $from_planet->id;
        $this->to_planet_id = $to_planet->id;
        $this->modifyTravelFleet($fleet);
        $this->departure = Carbon::now();
        $this->arrival = Carbon::now()->addMinutes($from_planet->calculateDistanceToOtherPlanet($to_planet));
        $this->save();

        dispatch((new TravelCompleted($this))->delay(Carbon::now()->addMinutes($from_planet->calculateDistanceToOtherPlanet($to_planet))));
    }

    /**
     * Run on TravelCompleted Job.
     */
    public function travelIsComplete(){
        if($this->type == 'attacking'){
            // TODO: Dispatch attack job.
        }else if($this->type == 'returning') {
            // TODO: Return fleet to Planet
            // TODO: Add victory resources to Planet (if any)
            $notification = new Notification();
            $notification->sendFleetHasReturnedNotification($this);
        }
    }

    /**
     * @param Planet $from_planet
     * @param Planet $to_planet
     * @return int
     */
    public static function calculateTravelTime(Planet $from_planet, Planet $to_planet){
        $loc1 = $from_planet->SolarSystem()->first()->location;
        $loc2 = $to_planet->SolarSystem()->first()->location;
        $x1 = $loc1[0];
        $y1 = $loc1[1];
        $x2 = $loc2[0];
        $y2 = $loc2[1];

        $dx = ($x2 - $x1) * ($x2 - $x1);
        $dy = ($y2 - $y1) * ($y2 - $y1);

        $minutes = 1440; // 1 days
        $base_distance = 400;
        $rate = $minutes / $base_distance;

        $time_distance = ceil((sqrt($dx + $dy) * $rate));

        return intval($time_distance / GlobalRate::getGlobalTravelSpeed());
    }

    /**
     * Modify the Fleet of this Travel, if ship type is already in the fleet it will change to the new amount.
     * Otherwise, it will add the ship type and amount to the current fleet in this Travel.
     *
     * Parameter example : 1, 2 -> indicating ship type id 1 and amount of 2 ships.
     *
     * @param array $fleet
     */
    public function modifyTravelFleet($fleet){
        $temp_fleet = [];
        array_push($temp_fleet, $fleet['fighters'], $fleet['bombers'], $fleet['corvettes'], $fleet['frigates'], $fleet['destroyers']);

        $this->fleet = $temp_fleet;
        return;
    }


}
