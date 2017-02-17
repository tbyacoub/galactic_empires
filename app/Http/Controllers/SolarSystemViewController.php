<?php

namespace App\Http\Controllers;

use App\Planet;
use App\PlanetType;
use App\SolarSystem;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolarSystemViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the galaxy map.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSystemFromGalaxyMap($system_id)
    {
		// Get the ids, names, and locations of all solar systems.
		//$solarSystems = DB::table('solar_systems')->select('id', 'name', 'location')->get();
		
		// Load the galaxy map page and pass it the solar systems for rendering.
        return view('solar_system_view', compact('system_id'));
    }
}

?>