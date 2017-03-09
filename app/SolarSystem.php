<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'max_planets', 'location',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array the location coordinates [x,y]
     */
    protected $casts = [
        'location' => 'array',
    ];

    /**
     * @return Planets[] all the planets that belong in this Solar System
     */
    public function planets()
    {
        return $this->hasMany('App\Plant');
    }

}
