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
     * @var array
     */
    protected $casts = [
        'location' => 'array',
    ];

    /**
     * Returns all planets in this solar system.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planets()
    {
        return $this->hasMany('App\Plant');
    }

}
