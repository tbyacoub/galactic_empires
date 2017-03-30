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
     */
    public function updateGlobalRates(Request $request){
        $global = GlobalRate::find(1);
        $global->{$request->param} = $request->value;
        $global->save();
    }
}
