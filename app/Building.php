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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_upgrading' => 'boolean',
    ];

    public function planet(){
        return $this->belongsTo('App\Planet');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function upgrade(){
        return $this->belongsTo('App\Upgrade');
    }

    public function description(){
        return $this->belongsTo('App\Description');
    }

    public function getLevel(){
        return $this->current_level;
    }

    public function getMaxLevel(){
        return $this->upgrade()->max_level;
    }

    public function setUpgrading($upgrading){
        $this->is_upgrading = $upgrading;
        $this->save();
    }

    public function upgradeable(){
        return $this->getLevel() < $this->maxLevel();
    }

    public function isUpgrading(){
        return $this->is_upgrading;
    }

    public function upgradeTime(){
        $time = $this->upgrade()->first()->base_minutes;
        $time_rate = $this->upgrade()->first()->rate_minutes;
        return ($this->getLevel() * $time_rate) + $time;
    }

    public function incrementLevel(){
        $this->increment('current_level');
    }

}
