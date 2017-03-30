<?php

namespace App\Http\Controllers;

use App\SolarSystem;
use Illuminate\Http\Request;

class GalaxyMapController extends Controller
{

    /**
     * Show the galaxy map.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solarSystems = SolarSystem::all();
        return view('content.galaxy_map', compact('solarSystems'));
    }

    public function solarSystem(SolarSystem $solarSystem){
        $showRightPanel = false;
        return view('content.solar_system_view', compact('solarSystem', 'showRightPanel'));
    }

}
