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
        return $this->upgrade()->first()->max_level;
    }
    /**
     * Sets the upgrading status of this building to upgrading
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
     * Checks : Building is not currently upgrading
     *          Building can Upgrade (Planet has enough resources for the costs)
     *          Building is not already max level.
     *
     * @return bool
     */
    public function upgradeable(){
        return !$this->isUpgrading() && $this->canUpgrade() && ($this->getLevel() < $this->getMaxLevel());
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
     * Check if this planet can afford to upgrade this building.
     * @return bool, true if it can afford the upgrade, false otherwise.
     */
    public function canUpgrade(){
        $planet = $this->planet()->first();
        return     ($planet->metal() >= $this->getMetalCostToUpgrade())
            && ($planet->crystal() >= $this->getCrystalCostToUpgrade())
            && ($planet->energy() >= $this->getCrystalCostToUpgrade());
    }
    /**
     * Decrement the resources cost of upgrading this building.
     */
    public function decrementBuildingCost(){
        $planet = $this->planet()->first();
        $metal_remainder = $planet->metal() - $this->getMetalCostToUpgrade();
        $crystal_remainder = $planet->crystal() - $this->getCrystalCostToUpgrade();
        $energy_remainder = $planet->energy() - $this->getEnergyCostToUpgrade();
        $this->planet()->first()->setResources($metal_remainder, $crystal_remainder, $energy_remainder);
    }
    /**
     * Get the Metal cost of upgrading this building.
     * @return float|int
     */
    public function getMetalCostToUpgrade(){
        $gr = \App\GlobalRate::first();
        $base_metal = $this->upgrade()->first()->base_metal;
        $rate_metal = $this->upgrade()->first()->rate_metal;
        return $this->getLevel() * $base_metal * $rate_metal / $gr->building_cost_rate;
    }
    /**
     * Get the Energy cost of upgrading this building.
     * @return float|int
     */
    public function getEnergyCostToUpgrade(){
        $gr = \App\GlobalRate::first();
        $base_energy = $this->upgrade()->first()->base_energy;
        $rate_energy = $this->upgrade()->first()->rate_energy;
        return $this->getLevel() * $base_energy * $rate_energy / $gr->building_cost_rate;
    }
    /**
     * Get the Crystal cost of upgrading this building.
     * @return float|int
     */
    public function getCrystalCostToUpgrade(){
        $gr = \App\GlobalRate::first();
        $base_crystal = $this->upgrade()->first()->base_crystal;
        $rate_crystal = $this->upgrade()->first()->rate_crystal;
        return $this->getLevel() * $base_crystal * $rate_crystal / $gr->building_cost_rate;
    }
    /**
     * Called after BuildingUpgraded event.
     *
     * Kick-In the Product specific bonuses after building upgrades.
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
