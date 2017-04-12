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

    /**
     * Updates the hold capacity of the fleet
     */
    public function updateCapacity($capacity){
        $this->capacity = $capacity;
        $this->save();
    }

    public function attack()
    {
        return $this->product()->first()->characteristics['attack'];
    }

    public function health()
    {
        return $this->product()->first()->characteristics['health'];
    }

    public function defense()
    {
        return $this->product()->first()->characteristics['defense'];
    }

    public function multipliers()
    {
        return $this->product()->first()->characteristics['multipliers'];
    }

    public function multiplier($shipType)
    {
        return $this->product()->first()->characteristics['multipliers'][$shipType];
    }
}
