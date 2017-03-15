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
        'name', 'type', 'img_path',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_upgrading' => 'boolean',
    ];

    /**
     * Returns the planet that owns this building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planet(){
        return $this->belongsTo('App\Planet');
    }

    /**
     * Returns the production characteristics of the this building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo('App\Product');
    }

    /**
     * Returns upgrade information of this building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upgrade(){
        return $this->belongsTo('App\Upgrade');
    }

    /**
     * Returns the description of the=is building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function description(){
        return $this->belongsTo('App\Description');
    }

    /**
     * Returns the current level of this building.
     *
     * @return integer
     */
    public function getLevel(){
        return $this->current_level;
    }

    /**
     * Returns the max level that can be reached by this building.
     *
     * @return integer
     */
    public function getMaxLevel(){
        return $this->upgrade()->max_level;
    }

    /**
     * Sets the upgrading status of this building to uograding
     *
     * @param $upgrading boolean
     */
    public function setUpgrading($upgrading){
        $this->is_upgrading = $upgrading;
        $this->save();
    }

    /**
     * Returns whether this building is upgradable
     *
     * @return bool
     */
    public function upgradeable(){
        return $this->getLevel() < $this->maxLevel();
    }

    /**
     * Returns the upgrading status of this building
     *
     * @return boolean
     */
    public function isUpgrading(){
        return $this->is_upgrading;
    }

    /**
     * Returnss the upgrade duration of this building.
     *
     * @return int
     */
    public function upgradeTime(){
        $time = $this->upgrade()->first()->base_minutes;
        $time_rate = $this->upgrade()->first()->rate_minutes;
        return ($this->getLevel() * $time_rate) + $time;
    }

    /**
     * Increment the level of this building by one.
     */
    public function incrementLevel(){
        $this->increment('current_level');
    }

    /**
     * Called after BuildingUpgraded event.
     *
     * Kick-In the Product specifics after building upgrades.
     */
    public function setProduct(){
        $name = $this->description()->first()->name;

        switch ($name){
            case "metal_storage":
                    $this->planet()->first()->updateMetalStorage();
                break;
            case "crystal_storage":
                    $this->planet()->first()->updateCrystalStorage();
                break;
            case "energy_storage":
                    $this->planet()->first()->updateEnergyStorage();
                break;

        }
    }

}
