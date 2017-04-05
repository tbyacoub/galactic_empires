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
        $outgoing = Auth::user()->fromTravelsAllPlanets();
        $incoming = Auth::user()->toTravelsAllPlanets();
        return view('layouts.home', compact('planets', 'outgoing', 'incoming'));
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

        /* UNCOMMENT THIS FOR DEMO OR PRODUCTION */
        if($from_planet->user()->first()->id == $to_planet->user()->first()->id){
            return back()->withErrors(["You can't attack your own Planet."]);
        }

        // Check to make sure at least 1 ship has been selected.
        $zero_check = $request->all();
        if($zero_check['fighters'] == 0 && $zero_check['bombers'] == 0 && $zero_check['corvettes'] == 0
            && $zero_check['frigates'] == 0 && $zero_check['destroyers'] == 0){
            return back()->withErrors(["Select ships to create an Attack Fleet."]);
        }

        // Validate for negative numbers & check max based on Planet.
        $validator = Validator::make($request->all(), [
            'fighters' => 'min:0|max:'.$from_planet->numFighters.'|integer',
            'bombers' => 'min:0|max:'.$from_planet->numBombers.'|integer',
            'corvettes' => 'min:0|max:'.$from_planet->numCorvettes.'|integer',
            'frigates' => 'min:0|max:'.$from_planet->numFrigates.'|integer',
            'destroyers' => 'min:0|max:'.$from_planet->numDestroyers.'|integer',
        ])->validate();


        // Dispatch the travel of type attacking.
        $travel = new Travel();
        $travel->startTravel($from_planet, $to_planet, $request->all(), 'attacking');

        return redirect('/home');
    }

    public function indexPlanetOverview(Planet $planet){
        return view('content.planet-overview', compact('planet'));
    }

    public function indexLaunchAttack(Planet $from_planet, Planet $to_planet){

        if($from_planet->user()->first()->id != Auth::id()) {
            return redirect('/home');
        }
        return view('content.launch-attack', compact('from_planet', 'to_planet'));
    }

    public function completeTutorial(){
        Auth::user()->completeTutorial();
        return back();
    }
}
