<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{


    public function planet(){
        $this->belongsTo('App\Planet');
    }

}
