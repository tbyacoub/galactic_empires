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
        $this->bonus = (1 + (0.25 * ($buildingLevel - 1)));
    }

    /**
     * Calculates the new metal resource count for this planet based on metalRate
     *
     * @param $global_rate
     * @param $research_rate
     * @param $alloy_rate
     * @return float|int
     */
    public function calculateMetal($global_rate, $research_rate, $alloy_rate){
        return ($this->characteristics['metal_base_rate'] * $this->bonus * (($global_rate + $research_rate + $alloy_rate) / 3)) / 12;
    }

    /**
     * Calculates the new crystal resource count for this planet based on crystalRate
     *
     * @param $global_rate
     * @param $research_rate
     * @return float|int
     */
    public function calculateCrystal($global_rate, $research_rate){
        return ($this->characteristics['crystal_base_rate'] * $this->bonus * (($global_rate + $research_rate) / 2)) / 12;
    }

    /**
     * Calculates the new energy resource count for this planet based on energyRate
     *
     * @param $global_rate
     * @param $research_rate
     * @return float|int
     */
    public function calculateEnergy($global_rate, $research_rate){
        return ($this->characteristics['energy_base_rate'] * $this->bonus * (($global_rate + $research_rate) / 2)) / 12;
    }
}
