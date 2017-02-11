<?php

namespace App\Http\Controllers;

use App\Planet;
use App\PlanetType;
use App\SolarSystem;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $solarSystems = SolarSystem::all();
		
		/*
        return view('home', compact(
            'planets',
            'users',
            'solarSystems',
            'planetTypes',
            'planetsOwened'
        ));
		*/
		
		return view('galaxy_map');
    }
}
