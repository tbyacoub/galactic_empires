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
}
