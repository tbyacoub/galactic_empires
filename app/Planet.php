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
     * @var array, resources casted to array.
     */
    protected $casts = [
        'resources' => 'array',
    ];

    /**
     * Get the Solar System model that this Planet belongs to.
     *
     * @return SolarSystem, the Solar System of this Planet.
     */
    public function SolarSystem()
    {
        return $this->belongsTo('App\SolarSystem');
    }


    /**
     * Get the Planet Type Model of this planet.
     *
     * @return PlanetType, type of this Planet
     */
    public function PlanetType()
    {
        return $this->belongsTo('App\PlanetType');
    }

    /**
     * Get the Building Models that belong to this Planet
     *
     * @return Building[] that belong to this planet.
     */
    public function buildings(){
        return $this->belongsToMany('App\Building')->withPivot('id', 'current_level');
    }

    /**
     * Sum of all planet's metal belonging to this User.
     *
     * @return integer, sum of this planet's metal.
     */
    public function metal(){
        return $this->resources['metal'];
    }

    /**
     * Sum of all planet's crystal belonging to this User.
     *
     * @return integer, sum of this planet's crystal.
     */
    public function crystal(){
        return $this->resources['crystal'];
    }

    /**
     * Sum of all planet's energy belonging to this User.
     *
     * @return integer, sum of this planet's energy.
     */
    public function energy()
    {
        return $this->resources['energy'];
    }

    /**
     * Get the User Model that this Planet belongs to.
     *
     * @return User, user who owns this Planet.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
