<?php

namespace App\Http\Controllers;

use App\Events\GameSettings;
use App\Events\StatusUpdated;
use App\Planet;
use App\SolarSystem;
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
        $outgoing = Auth::user()->fromTravelsAllPlanets();
        $incoming = Auth::user()->toTravelsAllPlanets();
        return view('layouts.home', compact('outgoing', 'incoming'));
    }

    public function solarSystem(SolarSystem $solarSystem){
        $showRightPanel = false;
        return view('solar_system_view', compact('solarSystem', 'showRightPanel'));
    }


    public function attack(Planet $from_planet, Planet $to_planet, Request $request){

        /* UNCOMMENT THIS FOR DEMO OR PRODUCTION
        if($from_planet->user()->first()->id == $to_planet->user()->first()->id){
            return back()->withErrors(["You can't attack your own Planet."]);
        }
        */

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