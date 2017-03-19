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
        'name', 'radius', 'resources', 'metal_storage', 'crystal_storage', 'energy_storage'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'resources' => 'array',
    ];

    /**
     * Returns the user that owns this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns the solar system where this planet resides.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SolarSystem()
    {
        return $this->belongsTo('App\SolarSystem');
    }

    /**
     * Return the type of this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function PlanetType()
    {
        return $this->belongsTo('App\PlanetType');
    }

    /**
     * Returns all the buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings(){
        return $this->hasMany('App\Building');
    }

    /**
     * Returns all the facilities buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facilitiesBuildings(){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description){
            $description->where('type', 'facility');
        })->get();
    }

    /**
     * Returns all the resources buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resourcesBuildings(){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description){
            $description->where('type', 'resource');
        })->get();
    }

    /**
     * Returns all the planetary buildings buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planetaryDefensesBuildings(){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description){
            $description->where('type', 'planetary_defense');
        })->get();
    }

    /**
     * Returns all the research buildings buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function researchBuildings(){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description){
            $description->where('type', 'research');
        })->get();
    }

    /**
     * Returns all the shipyard buildings buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipyardBuildings(){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description){
            $description->where('type', 'shipyard');
        })->get();
    }

    /**
     * Sets the planet resources.
     *
     * @param $metal integer
     * @param $crystal integer
     * @param $energy integer
     */
    public function setResources($metal, $crystal, $energy){
        $this->resources = [
            'metal' => ceil($metal),
            'crystal' => ceil($crystal),
            'energy' => ceil($energy)
        ];
        $this->save();
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

    /**
     * Gets the Metal Storage Building of this planet.
     * @return \App\Building
     */
    public function metalStorageBuilding(){
        return $this->buildings()->with('description', 'upgrade', 'product')->whereHas('description', function($description){
            $description->where('name', 'metal_storage');
        })->first();
    }

    /**
     * Gets the Crystal Storage Building of this planet.
     * @return \App\Building
     */
    public function crystalStorageBuilding(){
        return $this->buildings()->with('description', 'upgrade', 'product')->whereHas('description', function($description){
            $description->where('name', 'crystal_storage');
        })->first();
    }

    /**
     * Gets the Energy Storage Building of this planet.
     * @return \App\Building
     */
    public function energyStorageBuilding(){
        return $this->buildings()->with('description', 'upgrade', 'product')->whereHas('description', function($description){
            $description->where('name', 'energy_storage');
        })->first();
    }

    /**
     * Updates the new storage capacity of this planet, based on the current level this storage building.
     *
     * Normally called after a storage building upgrades (Building->setProduct())
     */
    public function updateMetalStorage(){
        $metal_storage = $this->metalStorageBuilding();

        $level = $metal_storage->current_level;
        $base = $metal_storage->product->characteristics['storage_base'];
        $rate = $metal_storage->product->characteristics['storage_base_rate'];

        $this->metal_storage = ($level * $base * $rate);
        $this->save();
    }

    /**
     * Updates the new storage capacity of this planet, based on the current level this storage building.
     *
     * Normally called after a storage building upgrades (Building->setProduct())
     */
    public function updateCrystalStorage(){
        $crystal_storage = $this->crystalStorageBuilding();

        $level = $crystal_storage->current_level;
        $base = $crystal_storage->product->characteristics['storage_base'];
        $rate = $crystal_storage->product->characteristics['storage_base_rate'];

        $this->crystal_storage = ($level * $base * $rate);
        $this->save();
    }

    /**
     * Updates the new storage capacity of this planet, based on the current level this storage building.
     *
     * Normally called after a storage building upgrades (Building->setProduct())
     */
    public function updateEnergyStorage(){
        $energy_storage = $this->energyStorageBuilding();

        $level = $energy_storage->current_level;
        $base = $energy_storage->product->characteristics['storage_base'];
        $rate = $energy_storage->product->characteristics['storage_base_rate'];

        $this->energy_storage = ($level * $base * $rate);
        $this->save();
    }
}
