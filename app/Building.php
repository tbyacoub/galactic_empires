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
        return $this->morphMany('App\Upgrade', 'upgradable');
    }

    public function products() {
        return $this->morphMany('App\Product', 'producible');
    }

    private function canUpgrade(){
        // To do : check for cost
        // To do : check that it's not max level
        return true;
    }

}
