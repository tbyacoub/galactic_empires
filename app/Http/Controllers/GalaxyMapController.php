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
        //$solarSystems = SolarSystem::all();
		
		$solarSystems = DB::table('solar_systems')->select('id', 'name', 'location')->get();
		
		
        return view('galaxy_map', compact('solarSystems'));
		
		
		//return view('galaxy_map');
    }
}
