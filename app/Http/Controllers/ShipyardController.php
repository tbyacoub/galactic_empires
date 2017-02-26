<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ShipyardController extends Controller
{
    public function index(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('shipyard');

        return view('player.shipyard', compact('buildings'));
    }
}
