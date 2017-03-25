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

    public function fromTravels(){
        return $this->hasMany('App\Travel', 'from_planet_id', 'id');
    }

    public function toTravels(){
        return $this->hasMany('App\Travel', 'to_planet_id', 'id');
    }

    /**
     * Returns all building in this planet that have type $type.
     *
     * @param $type building type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingsOfType($type){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description) use ($type){
            $description->where('type', $type);
        });
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

    public function fleets()
    {
        return $this->hasMany('\App\Fleet');
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

    /**
     * Modifies the resources on a given planet
     *
     * @param $amount
     */
    public function modifyMetal($amount){
        $value = $this->metal() + $amount;
        $value = ($this->metal() + $amount < 0) ? 0 : min($value, $this->metal_storage) ;
        $this->setResources($value, $this->crystal(), $this->energy());
    }

    /**
     * Modifies the resources on a given planet
     * 
     * @param $amount
     */
    public function modifyCrystal($amount){
        $value = $this->crystal() + $amount;
        $value = ($this->crystal() + $amount < 0) ? 0 : min($value, $this->crystal_storage) ;
        $this->setResources($this->metal(), $value, $this->energy());
    }

    /**
     * Modifies the resources on a given planet
     *
     * @param $amount
     */
    public function modifyEnergy($amount){
        $value = $this->energy() + $amount;
        $value = ($this->energy() + $amount < 0) ? 0 : min($value, $this->energy_storage) ;
        $this->setResources($this->metal(), $this->crystal(), $value);
    }

}
