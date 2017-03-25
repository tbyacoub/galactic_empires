<?php

namespace App\Http\Controllers;

use App\Events\GameSettings;
use App\Events\StatusUpdated;
use App\Planet;
use App\Travel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

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

    public function attack(Planet $from_planet, Planet $to_planet, Request $request){

        $validator = Validator::make($request->all(), [
            'fighters' => 'min:0|max:'.$from_planet->numFrigates.'|integer',
            'bombers' => 'min:0|max:'.$from_planet->numBombers.'|integer',
            'corvettes' => 'min:0|max:'.$from_planet->numCorvettes.'|integer',
            'frigates' => 'min:0|max:'.$from_planet->numFrigates.'|integer',
            'destroyers' => 'min:0|max:'.$from_planet->numDestroyers.'|integer',
        ])->validate();


        $travel = new Travel();
        $travel->startTravel($from_planet, $to_planet, $request->all(), 'attacking');

        return redirect('/home');
    }

    public function indexPlanetOverview(Planet $planet){

        return view('content.planet-overview', compact('planet'));
    }

    public function indexLaunchAttack(Planet $from_planet, Planet $to_planet){

        return view('content.launch-attack', compact('from_planet', 'to_planet'));
    }
}