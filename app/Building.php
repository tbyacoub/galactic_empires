<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'current_level', 'building_prototype_id', 'planet_id',
    ];

    public function planet(){
        return $this->belongsTo('App\Planet');
    }

    public function name(){
        return $this->buildingPrototype()->first()->name();
    }

    public function img(){
        return $this->buildingPrototype()->first()->img();
    }

    public function buildingPrototype(){
        return $this->belongsTo('App\BuildingPrototype');
    }

    public function isResourceBuilding(){
        return $this->buildingPrototype()->first()->type() == "resource";
    }

    public function isDefenseBuilding(){
        return $this->buildingPrototype()->first()->type() == "defense";
    }

    public function isFacilityBuilding(){
        return $this->buildingPrototype()->first()->type() == "facility";
    }

    public function isShipyardBuilding(){
        return $this->buildingPrototype()->first()->type() == "shipyard";
    }


}
