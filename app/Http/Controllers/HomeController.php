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
        $outgoing = Auth::user()->fromtravelsallplanets();
        $incoming = Auth::user()->toTravelsAllPlanets();
        return view('layouts.home', compact('outgoing', 'incoming'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeTutorial(){
        Auth::user()->completeTutorial();
        return redirect('/home');
    }
}