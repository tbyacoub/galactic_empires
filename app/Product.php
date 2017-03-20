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
     * Calculate production rate bonus as a function of buildingLevel and global multiplier,
     * divide by 12 to convert hourly rate to every 5 minutes.
     *
     * @param $buildingLevel
     */
    public function calculateBonus($buildingLevel){
        $this->bonus = (1 + (0.25 * (1 - $buildingLevel)));
    }

    /**
     * Calculates the new metal resource count for this planet based on metalRate
     *
     * @param $metalRate integer
     * @return float|int
     */
    public function calculateMetal($metalRate){
        return (($this->characteristics['metal_base_rate']) * $this->bonus * $metalRate) / 12;
    }

    /**
     * Calculates the new crystal resource count for this planet based on crystalRate
     *
     * @param $crystalRate integer
     * @return float|int
     */
    public function calculateCrystal($crystalRate){
        return (($this->characteristics['crystal_base_rate']) * $this->bonus * $crystalRate) / 12;
    }

    /**
     * Calculates the new energy resource count for this planet based on energyRate
     *
     * @param $energyRate integer
     * @return float|int
     */
    public function calculateEnergy($energyRate){
        return (($this->characteristics['energy_base_rate']) * $this->bonus * $energyRate) / 12;
    }
}
