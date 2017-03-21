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

    public function fromPlanet(){
        return $this->hasOne('App\Planet', 'id', 'from_planet_id');
    }

    public function toPlanet(){
        return $this->hasOne('App\Planet', 'id', 'to_planet_id');
    }

    public function getTravelPercent(){
        $current = Carbon::now()->timestamp - $this->departure->timestamp;
        $difference = $this->arrival->timestamp - $this->departure->timestamp;

        return 100 * ($current/$difference);
    }

    /**
     * Modify the Fleet of this Travel, if ship type is already in the fleet it will change to the new amount.
     * Otherwise, it will add the ship type and amount to the current fleet in this Travel.
     *
     * Parameter example : 1, 2 -> indicating ship type id 1 and amount of 2 ships.
     *
     * @param array $fleet
     */
    public function modifyTravelFleet($type, $amount){

        $this->type = "attacking";
        $this->from_planet_id = 142;
        $this->to_planet_id = 141;
        $this->departure = Carbon::now();
        $this->arrival = Carbon::now()->addHour(1);

        /*
         * This loop is just to increment/decrement the amount if the ship type
         * is already in this travel fleet. Otherwise it will add the new one at the end.
         */
        $copy_fleet = $this->fleet;
        for($i = 0; $i < $copy_fleet; $i++){
            if($copy_fleet[$i]['type'] == $type){
                $copy_fleet[$i]['amount'] = $amount;
                $this->fleet = $copy_fleet;
                return;
            }else if($i == count($copy_fleet) -1){
                array_push($copy_fleet, ["type" => $type, 'amount'=>$amount]);
                $this->fleet = $copy_fleet;
                return;
            }
        }

        // If the currently fleet is empty, it will default to this.
        $this->fleet = [["type" => $type, 'amount'=>$amount]];
    }


}
