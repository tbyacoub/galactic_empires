<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FacilitiesController extends Controller
{
    public function index(){

        $buildings = Auth::user()->planets()->first()->resourceBuildings();

        //dd($buildings[0]);
        return view('player.facilities', compact('buildings'));
    }
}
