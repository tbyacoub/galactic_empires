<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BuildingViewController extends Controller
{
    public function indexFacilities(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('facility');
        $type = "Facilities";

        return view('player.building-view', compact('buildings', "type"));
    }

    public function indexShipyard(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('shipyard');
        $type = "Shipyard";

        return view('player.building-view', compact('buildings', "type"));
    }

    public function indexDefenses(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('defense');
        $type = "Planetary Defense";

        return view('player.building-view', compact('buildings', "type"));
    }

    public function indexResources(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('resource');
        $type = "Resources";

        return view('player.building-view', compact('buildings', "type"));
    }

}
