<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count', 'capacity',
    ];

    /**
     * Returns the planet that owns this building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planet()
    {
    	return $this->belongsTo('App\Planet');
    }

    /**
     * Returns the description of the=is building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function description()
    {
    	return $this->belongsTo('App\Description');
    }

    /**
     * Returns the production characteristics of the this building.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
