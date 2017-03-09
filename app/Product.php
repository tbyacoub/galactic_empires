<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    private $bonus;

    protected $casts = [
        'characteristics' => 'array',
    ];

    public function buildings(){
        return $this->hasMany('App\Building');
    }

    /**
    * Calculate production rate bonus as a function of current level and global miltiplier,
    * divide by 12 to convert hourly rate to every 5 minutes.
    */
    public function calculateBonus($buildingLevel){
        $this->bonus = (1 + (0.25 * (1 - $buildingLevel)));
    }

    public function calculateMetal($metalRate){
        return (($this->characteristics['metal_base_rate']) * $this->bonus * $metalRate) / 12;
    }

    public function calculateCrystal($crystalRate){
        return (($this->characteristics['crystal_base_rate']) * $this->bonus * $crystalRate) / 12;
    }

    public function calculateEnergy($energyRate){
        return (($this->characteristics['energy_base_rate']) * $this->bonus * $energyRate) / 12;
    }
}
