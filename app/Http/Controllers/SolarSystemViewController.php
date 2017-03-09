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
     * @param  $system_id ID of solar system to view
     *     *
     * @return \Illuminate\Http\Response
     */
    public function viewSystemFromGalaxyMap($system_id)
    {
		// GGet the ids, names, and image paths for all planets in the 
		// specified solar system.
		$systemPlanets = DB::table('planets')
			->join('planet_types', 'planets.planetType_id', '=', 'planet_types.id')
			->select('planets.id', 'planets.name', 'planet_types.img_path')
			->where('solarSystem_id', '=', $system_id)
			->orderBy('id', 'asc')
			->get();
			
		// Get some data about the specified solar system.
		$solarSystem = DB::table('solar_systems')
			->select('name', 'location')
			->where('id', '=', $system_id)
			->first();
		
		$showRightPanel = false;
		
		// Load the galaxy map page and pass it the solar systems for rendering.
        return view('solar_system_view', compact('systemPlanets', 'solarSystem', 'system_id', 'showRightPanel'));
    }
}

?>