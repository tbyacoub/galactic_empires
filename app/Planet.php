<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Planet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'radius', 'resources', 'metal_storage', 'crystal_storage', 'energy_storage'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'resources' => 'array',
    ];

    /**
     * Returns the user that owns this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Returns the solar system where this planet resides.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SolarSystem()
    {
        return $this->belongsTo('App\SolarSystem');
    }
    /**
     * Return the type of this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function PlanetType()
    {
        return $this->belongsTo('App\PlanetType');
    }
    /**
     * Returns all the buildings on this planet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings(){
        return $this->hasMany('App\Building');
    }

    public function fromTravels(){
        return $this->hasMany('App\Travel', 'from_planet_id', 'id');
    }

    public function toTravels(){
        return $this->hasMany('App\Travel', 'to_planet_id', 'id');
    }

    /**
     * Returns all building in this planet that have type $type.
     *
     * @param $type building type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingsOfType($type){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description) use ($type){
            $description->where('type', $type);
        });
    }

    /**
     * Returns all building in this planet that have name $name.
     *
     * @param $name building name
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingOfName($name){
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function($description) use ($name){
            $description->where('name', $name);
        });
    }

    /**
     * Returns all fleet that belongs to this planet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fleets()
    {
        return $this->hasMany('\App\Fleet');
    }

    /**
     * Returns fleet that has than name $name that belong to this planet
     *
     * @param $name name of fleet
     */
    public function fleet($name) {
        return $this->fleets()->with('description', 'product')->whereHas('description', function ($description) use ($name) {
            $description->where('name', $name);
        });
    }

    /**
     * Sets the planet resources.
     *
     * @param $metal integer
     * @param $crystal integer
     * @param $energy integer
     */
    public function setResources($metal, $crystal, $energy){
        $this->resources = [
            'metal' => ceil($metal),
            'crystal' => ceil($crystal),
            'energy' => ceil($energy)
        ];
        $this->save();
    }

    /**
     * Sum of all planet's metal belonging to this User.
     *
     * @return integer
     */
    public function metal(){
        return $this->resources['metal'];
    }

    /**
     * Sum of all planet's crystal belonging to this User.
     *
     * @return integer
     */
    public function crystal(){
        return $this->resources['crystal'];
    }

    /**
     * Sum of all planet's energy belonging to this User.
     *
     * @return integer
     */
    public function energy()
    {
        return $this->resources['energy'];
    }

    public function removeShipsFromPlanetFleet($fleet){
        $babylon = $this->fleet('babylon5')->first();
        $babylon->count = $babylon->count - $fleet[0];
        $babylon->save();
        $battlestar_galactica = $this->fleet('battlestar_galactica')->first();
        $battlestar_galactica->count = $battlestar_galactica->count - $fleet[1];
        $battlestar_galactica->save();
        $stargate = $this->fleet('stargate')->first();
        $stargate->count = $stargate->count - $fleet[2];
        $stargate->save();
    }

    public function addShipsToPlanetFleet($fleet){
        $babylon = $this->fleet('babylon5')->first();
        $babylon->count = $babylon->count + $fleet[0];
        $babylon->save();
        $battlestar_galactica = $this->fleet('battlestar_galactica')->first();
        $battlestar_galactica->count = $battlestar_galactica->count + $fleet[1];
        $battlestar_galactica->save();
        $stargate = $this->fleet('stargate')->first();
        $stargate->count = $stargate->count + $fleet[2];
        $stargate->save();
    }

    /**
     * Calculates distance from this Planet to other Planet
     *
     * @param Planet $other
     * @return int distance in MINUTES
     */
    public function calculateDistanceToOtherPlanet(Planet $other){
        return Travel::calculateTravelTime($this,$other);
    }

    public function formattedTimeDistance(Planet $other){
        $minutes = Travel::calculateTravelTime($this,$other);
        if($minutes > 60){
           $hours = floor($minutes / 60);
        }else{
           return $minutes . "Minutes";
        }
        if($hours > 24){
            $days = floor($hours / 24);
        }else{
            return $hours . ' Hours, ' . ((int) $minutes % 60) . "Minutes";
        }
        return $days . 'Days, ' . $hours . ' Hours, ' .  $minutes % 60 . "Minutes";
    }

    public function setStorage($storage, $capacity){
        switch ($storage) {
            case "metal_storage":
                $this->metal_storage = $capacity;
                break;
            case "crystal_storage":
                $this->crystal_storage = $capacity;
                break;
            case "energy_storage":
                $this->energy_storage = $capacity;
                break;
        }
        $this->save();
    }

    /**
     * Modifies the resources on a given planet
     *
     * @param $amount
     */
    public function modifyMetal($amount){
        $value = $this->metal() + $amount;
        $value = ($this->metal() + $amount < 0) ? 0 : min($value, $this->metal_storage) ;
        $this->setResources($value, $this->crystal(), $this->energy());
    }

    /**
     * Modifies the resources on a given planet
     * 
     * @param $amount
     */
    public function modifyCrystal($amount){
        $value = $this->crystal() + $amount;
        $value = ($this->crystal() + $amount < 0) ? 0 : min($value, $this->crystal_storage) ;
        $this->setResources($this->metal(), $value, $this->energy());
    }

    /**
     * Modifies the resources on a given planet
     *
     * @param $amount
     */
    public function modifyEnergy($amount){
        $value = $this->energy() + $amount;
        $value = ($this->energy() + $amount < 0) ? 0 : min($value, $this->energy_storage) ;
        $this->setResources($this->metal(), $this->crystal(), $value);
    }
}