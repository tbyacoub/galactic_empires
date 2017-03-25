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

class PlanetOverviewController extends Controller
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
     * Show the planet overview.
     *
     * @param $system_id ID of he system the planet is in
     * @param $planet_id ID of the planet to display
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPlanet($system_id, $planet_id)
    {
		$planetInfo = DB::table('planets')
			->join('planet_types', 'planets.planet_type_id', '=', 'planet_types.id')
			->join('users', 'planets.user_id', '=', 'users.id')
			->select('planets.radius', 'planets.name', 'planets.resources', 'planet_types.img_path', 'users.name AS user_name')
			->where('planets.id', '=', $planet_id)
			->first();
			
		$solarSystemInfo = DB::table('solar_systems')
			->select('name', 'location')
			->where('solar_systems.id', '=', $system_id)
			->first();
		
        return view('planet_view', compact('solarSystemInfo', 'planetInfo'));
    }
	
	public function viewPlanetOverview()
	{
		$planets = Auth::user()->planets()->get();
        return view('planet_overview_view', compact('planets'));
	}
}

?>