<?php

namespace App\Http\Controllers;

use App\SolarSystem;

class GalaxyMapController extends Controller
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
    public function index()
    {
		// Get the ids, names, and locations of all solar systems.
        // $solarSystems = DB::table('solar_systems')->select('id', 'name', 'location')->get();
		$solarSystems = SolarSystem::all();

		// Load the galaxy map page and pass it the solar systems for rendering.
        return view('content.galaxy_map', compact('solarSystems'));
    }
}