<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{

    public function Upgradable(){
        return $this->morphTo();
    }

}
