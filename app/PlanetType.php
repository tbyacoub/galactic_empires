<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanetType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'img_path',
    ];

}
