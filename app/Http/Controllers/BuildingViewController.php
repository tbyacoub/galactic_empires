<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BuildingViewController extends Controller
{
    public function indexFacilities(){
        $user = Auth::user();
        $planets = $user->planets()->get();
        $buildings = $user->planets()->first()->buildingsOfType('facility');
        $type = "Facilities";
        return view('content.building-view', compact('buildings', "type", "user", "planets"));
    }

    public function indexShipyard(){
        $user = Auth::user();
        $planets = $user->planets()->get();
        $buildings = $user->planets()->first()->buildingsOfType('shipyard');
        $type = "Shipyard";

        return view('content.building-view', compact('buildings', "type", "user", "planets"));
    }

    public function indexDefenses(){
        $user = Auth::user();
        $planets = $user->planets()->get();
        $buildings = $user->planets()->first()->buildingsOfType('defense');
        $type = "Planetary Defense";

        return view('content.building-view', compact('buildings', "type", "user", "planets"));
    }

    public function indexResources(){
        $user = Auth::user();
        $planets = $user->planets()->get();
        $buildings = $user->planets()->first()->buildingsOfType('resource');
        $type = "Resources";

        return view('content.building-view', compact('buildings', "type", "user", "planets"));
    }

}
