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
     * Will return the Planet Model that this Building belongs to.
     *
     * @return Planet that this building belongs to.
     */
    public function planet(){
        return $this->belongsToMany('App\Planet');
    }

    /**
     * Will return the Upgrade Model (Upgrades Table) to it's respective type.
     *
     * @return Upgrade of this Building.
     */
    public function upgrades(){
        return $this->morphMany('App\Upgrade', 'upgradeable');
    }

    /**
     * Will return the Pruct Model (Products Table) to it's respectivie type.
     *
     * @return Product producible information of this Building.
     */
    public function products() {
        return $this->morphMany('App\Product', 'producible');
    }

}
