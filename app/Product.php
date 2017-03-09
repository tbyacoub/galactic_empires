<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    /**
     * @var array characteristics of the Model
     */
    protected $casts = [
        'characteristics' => 'array',
    ];


    /**
     * @return Product
     */
    public function producible() {
    	return $this->morphTo();
    }
}
