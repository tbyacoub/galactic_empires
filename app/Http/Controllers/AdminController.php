<?php

namespace App\Http\Controllers;

use App\GlobalRate;
use App\Planet;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of global rates.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function globalRates(){
        $globals = GlobalRate::first()->get();
        return view('admin.game-SETTINGS', compact('globals'));
    }

    /**
     * Update the global rates in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateGlobalRates(Request $request){
        $global = GlobalRate::find(1);
        
        $global->metal_rate = $request->metal_rate;
        $global->energy_rate = $request->energy_rate;
        $global->crystal_rate = $request->crystal_rate;

        $global->ship_build_time_rate = $request->ship_build_time_rate;
        $global->ship_cost_rate = $request->ship_cost_rate;

        $global->building_build_time_rate = $request->building_build_time_rate;
        $global->building_cost_rate = $request->building_cost_rate;

        $global->research_rate = $request->research_rate;
        $global->travel_rate = $request->travel_rate;

        $global->save();
        
        return back();
    }

    public function increaseStorage(Planet $planet, Request $request){

    }
}
