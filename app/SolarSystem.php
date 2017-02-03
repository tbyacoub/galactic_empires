<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'location' => 'array',
    ];

    public function planets()
    {
        return $this->hasMany('App\Plant');
    }

}
