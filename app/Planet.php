<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'radius', 'resources',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'resources' => 'array',
    ];

    public function SolarSystem()
    {
        return $this->belongsTo('App\SolarSystem');
    }

    public function PlanetType()
    {
        return $this->belongsTo('App\PlanetType');
    }

    public function buildings(){
        return $this->hasMany('App\Building');
    }


    /**
     * Sum of all planet's metal belonging to this User.
     *
     * @return integer
     */
    public function metal(){
        return $this->resources['metal'];
    }

    /**
     * Sum of all planet's crystal belonging to this User.
     *
     * @return integer
     */
    public function crystal(){
        return $this->resources['crystal'];
    }

    /**
     * Sum of all planet's energy belonging to this User.
     *
     * @return integer
     */
    public function energy()
    {
        return $this->resources['energy'];
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param $type string type of BuildingPrototype (type in DB)
     * @return array of type Building
     */
    public function buildingsOfType($type){
        $buildings = $this->buildings()->get();

        $resource_buildings = [];

        switch ($type){
            case "resource":
                foreach ($buildings as $b){
                    if($b->isResourceBuilding()) { array_push($resource_buildings, $b); }
                }
                break;

            case "shipyard":
                foreach ($buildings as $b){
                    if($b->isShipyardBuilding()) { array_push($resource_buildings, $b); }
                }
                break;

            case "defense":
                foreach ($buildings as $b){
                    if($b->isDefenseBuilding()) { array_push($resource_buildings, $b); }
                }
                break;

            case "facility":
                foreach ($buildings as $b){
                    if($b->isFacilityBuilding()) { array_push($resource_buildings, $b); }
                }
                break;

            default:
                break;
        }

        return $resource_buildings;
    }
    
    function createResource($resources){
        $json = [
            "metal" => $resources['metal'],
            "crystal" => $resources['crystal'],
            "energy" => $resources['energy']
        ];
        echo json_encode($json);
        return $json;
    }
}
