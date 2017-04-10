<?php

namespace App;

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
        'type', 'from_planet_id', 'to_planet_id', 'fleet',
        'metal', 'crystal', 'energy', 'departure', 'arrival',
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

    public static function time(Planet $origin, Planet $destination)
    {
        $loc1 = $origin->SolarSystem()->first()->location;
        $loc2 = $destination->SolarSystem()->first()->location;
        $x1 = $loc1[0];
        $y1 = $loc1[1];
        $x2 = $loc2[0];
        $y2 = $loc2[1];

        $dx = ($x2 - $x1) * ($x2 - $x1);
        $dy = ($y2 - $y1) * ($y2 - $y1);

        $minutes = 720; // 1 days
        $base_distance = 400;
        $rate = $minutes / $base_distance;

        $time_distance = ceil((sqrt($dx + $dy) * $rate));

        return intval($time_distance / GlobalRate::getGlobalTravelSpeed()) + 1;
    }

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


}