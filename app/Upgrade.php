<?php

namespace App;

use App\Traits\Upgradeable;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{

    /**
     * @return Upgrade
     */
    public function Upgradable(){
        return $this->morphTo();
    }

}
