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
		// Get the user's ID.
		$userId = Auth::user()->id;
		
		// Get the ID of the user who owns the planet being displayed.
		$planetOwnerId = DB::table('planets')
			->where('planets.id', '=', $planet_id)
			->value('user_id');
		
		// Flag for being owned by user.
		$ownedByUser = false;
		// The planet's info.
		$planetInfo = null;
		
		// If the planet is not owned by anyone...
		if ($planetOwnerId == -1)
		{
			$planetInfo = DB::table('planets')
			->join('planet_types', 'planets.planet_type_id', '=', 'planet_types.id')
			->select('planets.radius', 'planets.name', 'planet_types.img_path')
			->where('planets.id', '=', $planet_id)
			->first();
		}
		// Else if the planet is owned by the user...
		elseif ($userId == $planetOwnerId)
		{
			$ownedByUser = true;
			$planetInfo = DB::table('planets')
			->join('planet_types', 'planets.planet_type_id', '=', 'planet_types.id')
			->join('users', 'planets.user_id', '=', 'users.id')
			->select('planets.radius', 'planets.name', 'planets.resources', 'planet_types.img_path')
			->where('planets.id', '=', $planet_id)
			->first();
		}
		// Otherwise the planet is owned by another user...
		else
		{
			$planetInfo = DB::table('planets')
			->join('planet_types', 'planets.planet_type_id', '=', 'planet_types.id')
			->join('users', 'planets.user_id', '=', 'users.id')
			->select('planets.radius', 'planets.name', 'planet_types.img_path', 'users.name AS user_name')
			->where('planets.id', '=', $planet_id)
			->first();
		}
			
			// Name and location of the solar system the planet resides in.
		$solarSystemInfo = DB::table('solar_systems')
			->select('name', 'location')
			->where('solar_systems.id', '=', $system_id)
			->first();
		
        return view('planet_view', compact('solarSystemInfo', 'planetInfo', 'ownedByUser', 'planet_id'));
    }
	
	public function viewPlanetOverview(Request $request)
	{
		//$planets = Auth::user()->planets()->get();
		$planets = $request->user()->planets()->get();
        return view('planet_overview_view', compact('planets'));
	}
}

?>