<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    
    public function planet()
    {
    	return $this->belongsTo('App\Planet');
    }

    public function description()
    {
    	return $this->belongsTo('App\Description');
    }
}
