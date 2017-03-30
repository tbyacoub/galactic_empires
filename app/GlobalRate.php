<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalRate extends Model
{

    public $timestamps = false;

    public static function getGlobalMetalRate() {
        $globals = GlobalRate::first();
        return $globals->metal_rate;
    }

    public static function getGlobalEnergyRate() {
        $globals = GlobalRate::first();
        return $globals->energy_rate;
    }

    public static function getGlobalCrystalRate() {
        $globals = GlobalRate::first();
        return $globals->crystal_rate;
    }

    public static function getGlobalShipBuildTimeRate() {
        $globals = GlobalRate::first();
        return $globals->ship_build_time_rate;
    }

    public static function getGlobalShipCostRate() {
        $globals = GlobalRate::first();
        return $globals->ship_cost_rate;
    }

    public static function getGlobalBuildTimeRate() {
        $globals = GlobalRate::first();
        return $globals->building_build_time_rate;
    }

    public static function getGlobalBuildCostRate() {
        $globals = GlobalRate::first();
        return $globals->building_cost_rate;
    }

    public static function getGlobalResearchRate() {
        $globals = GlobalRate::first();
        return $globals->research_rate;
    }

    public static function getGlobalTravelSpeed() {
        $globals = GlobalRate::first();
        return $globals->travel_rate;
    }
}
