<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colonization extends Model
{
    public $fillable =[
        'planet_id', 'start', 'end'
    ];

    public $dates = [
        'start, end'
    ];

    public $timestamps = false;

    public function planet(){
        return $this->hasOne('App\Planet', 'id', 'planet_id');
    }
}
