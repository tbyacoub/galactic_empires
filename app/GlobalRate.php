<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalRate extends Model
{
    public $timestamps = false;

    protected function updateGlobals(array $data){

        $globals = GlobalRate::first();

        $globals->metal_rate = $data['metal_rate'];
        $globals->energy_rate = $data['energy_rate'];
        $globals->crystal_rate = $data['crystal_rate'];

        $globals->ship_build_time_rate = $data['ship_build_time_rate'];
        $globals->ship_cost_rate = $data['ship_cost_rate'];

        $globals->building_build_time_rate = $data['building_build_time_rate'];
        $globals->building_cost_rate = $data['building_cost_rate'];

        $globals->research_rate = $data['research_rate'];
        $globals->travel_rate = $data['travel_rate'];

        $globals->save();
    }

    public static function getGlobalMetalRate() {
        $globals = GlobalRate::first();
        return$globals->metal_rate;
    }

    public static function getGlobalEnergyRate() {
        $globals = GlobalRate::first();
        return$globals->energy_rate;
    }

    public static function getGlobalCrystalRate() {
        $globals = GlobalRate::first();
        return$globals->crystal_rate;
    }

    public static function getGlobalShipBuildTimeRate() {
        $globals = GlobalRate::first();
        return$globals->ship_build_time_rate;
    }

    public static function getGlobalShipCostRate() {
        $globals = GlobalRate::first();
        return$globals->ship_cost_rate;
    }

    public static function getGlobalBuildTimeRate() {
        $globals = GlobalRate::first();
        return$globals->building_build_time_rate;
    }

    public static function getGlobalBuildCostRate() {
        $globals = GlobalRate::first();
        return$globals->building_cost_rate;
    }

    public static function getGlobalResearchRate() {
        $globals = GlobalRate::first();
        return$globals->research_rate;
    }

    public static function getGlobalTravelSpeed() {
        $globals = GlobalRate::first();
        return$globals->travel_rate;
    }
}
