<?php

namespace App\Http\Controllers;

use App\Planet;
use App\PlanetType;
use App\SolarSystem;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planets = Planet::all()->count();
        $users = User::all()->count();
        $solarSystems = SolarSystem::all()->count();
        $planetTypes = PlanetType::all()->count();
        $planetsOwened = Auth::user()->planets()->count();
        return view('home', compact(
            'planets',
            'users',
            'solarSystems',
            'planetTypes',
            'planetsOwened'
        ));
    }
}
