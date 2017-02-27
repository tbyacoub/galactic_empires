<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function producible() {
    	return $this->morphTo();
    }
}
