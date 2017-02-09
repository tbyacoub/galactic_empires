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

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
