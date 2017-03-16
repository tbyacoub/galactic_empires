<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

    /**
     * Return all Describable objects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings()
    {
        return $this->hasMany('App\Building');
    }
}
