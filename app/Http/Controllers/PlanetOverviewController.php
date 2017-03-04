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
     * @return \Illuminate\Http\Response
     */
    public function viewPlanet($system_id, $planet_id)
    {
		
		$planetName = DB::table('planets')->select('name')->where('id', '=', $planet_id)->first();
		
        return view('planet_view', compact('planetName'));
    }
}

?>