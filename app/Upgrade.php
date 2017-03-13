<?php

namespace App;

use App\Traits\Upgradeable;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{

    /**
     * Returns all upgradeable buildings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings()
    {
        return $this->hasMany('App\Building');
    }
}
