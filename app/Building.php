<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'img_path',
    ];

    public function planet(){
        return $this->belongsToMany('App\Planet');
    }

    public function upgrades(){
        return $this->morphOne('App\Upgrade', 'upgradeable');
    }

    public function products() {
        return $this->morphMany('App\Product', 'producible');
    }

}
