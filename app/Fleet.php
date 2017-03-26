<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
	protected $fillable = [
        'multipliers'
    ];

	protected $casts = [
        'multipliers' => 'array',
    ];
    
    public function planet()
    {
    	return $this->belongsTo('App\Planet');
    }

    public function description()
    {
    	return $this->belongsTo('App\Description');
    }
}
