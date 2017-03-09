<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $casts = [
        'characteristics' => 'array',
    ];

    public function buildings(){
        return $this->hasMany('App\Building');
    }
}
