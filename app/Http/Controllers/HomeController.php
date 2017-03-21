<?php

namespace App\Http\Controllers;

use App\Events\GameSettings;
use App\Events\StatusUpdated;
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
     * @param $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $planets = $request->user()->planets()->get();
        $from_travels = Auth::user()->fromTravelsAllPlanets();
        $to_travels = Auth::user()->toTravelsAllPlanets();
        return view('layouts.home', compact('planets', 'from_travels', 'to_travels'));
    }

    public function planets(User $user_id)
    {
        return $user_id->planets()->get();
    }

    public function planet(Planet $planet_id)
    {
        return $planet_id;
    }

//    public function travels(){
//        $from_travels = Auth::user()->fromTravelsAllPlanets();
//        $to_travels = Auth::user()->toTravelsAllPlanets();
////        dd($from_travels, $to_travels);
//        return view('content.fleet-travel', compact('from_travels', 'to_travels'));
//    }

}
