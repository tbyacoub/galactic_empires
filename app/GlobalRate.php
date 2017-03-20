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
}
