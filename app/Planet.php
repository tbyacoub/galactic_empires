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
        return $this->belongsToMany('App\Building')->withPivot('id', 'current_level', 'is_upgrading');
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
