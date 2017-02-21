<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BuildingViewController extends Controller
{
    public function indexFacilities(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('facility');

        return view('player.building-view', compact('buildings'));
    }

    public function indexShipyard(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('shipyard');

        return view('player.building-view', compact('buildings'));
    }

    public function indexDefenses(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('defense');

        return view('player.building-view', compact('buildings'));
    }

    public function indexResources(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('resource');

        return view('player.building-view', compact('buildings'));
    }

}
