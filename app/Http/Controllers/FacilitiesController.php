<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FacilitiesController extends Controller
{
    /**
     * Returns player view for facility buildings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('facility');

        return view('player.facilities', compact('buildings'));
    }
}
