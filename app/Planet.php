<?php
namespace App;

use App\Traits\Colonizeable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed energy_storage
 * @property mixed crystal_storage
 * @property mixed metal_storage
 */
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

    public function isBeingColonized(){
        return $this->hasOne('App\Colonization', 'planet_id', 'id')->get()->count() == 1;
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
    public function buildings()
    {
        return $this->hasMany('App\Building');
    }

    public function fromTravels()
    {
        return $this->hasMany('App\Travel', 'from_planet_id', 'id');
    }

    public function toTravels()
    {
        return $this->hasMany('App\Travel', 'to_planet_id', 'id');
    }


    /**
     * Returns all building in this planet that have type $type.
     *
     * @param $type building type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingsOfType($type)
    {
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function ($description) use ($type) {
            $description->where('type', $type);
        });
    }

    /**
     * Returns all building in this planet that have name $name.
     *
     * @param $name building name
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingOfName($name)
    {
        return $this->buildings()->with('description', 'upgrade')->whereHas('description', function ($description) use ($name) {
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
    public function fleet($name)
    {
        return $this->fleets()->with('description', 'product')->whereHas('description', function ($description) use ($name) {
            $description->where('name', $name);
        });
    }

    public function getResearchResourceRate($building, $resource)
    {
        $research_building = $this->buildingOfName($building)->first();
        $resourceRate = $resource . '_bonus_rate';
        return 1 + ($research_building->current_level * $research_building->product->characteristics[$resourceRate]);
    }

    /**
     * Sets the planet resources.
     *
     * @param $metal integer
     * @param $crystal integer
     * @param $energy integer
     */
    public function setResources($metal, $crystal, $energy)
    {
        $this->resources = [
            'metal' => min(ceil($metal), $this->metal_storage),
            'crystal' => min(ceil($crystal), $this->crystal_storage),
            'energy' => min(ceil($energy), $this->energy_storage)
        ];
        $this->save();
    }

    /**
     * Sum of all planet's metal belonging to this User.
     *
     * @return integer
     */
    public function metal()
    {
        return $this->resources['metal'];
    }

    /**
     * Sum of all planet's crystal belonging to this User.
     *
     * @return integer
     */
    public function crystal()
    {
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

    public function setStorage($storage, $capacity)
    {
        $this->{$storage} = $capacity;
        $this->save();
    }

    public function canAffordColonization(){
        return $this->metal() >= Colonizeable::metalCost() && $this->crystal() >= Colonizeable::crystalCost() && $this->energy() >= Colonizeable::energyCost();
    }
}