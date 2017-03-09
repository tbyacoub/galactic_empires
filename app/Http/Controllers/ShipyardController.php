<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ShipyardController extends Controller
{
    /**
     * Return the player view for shipyard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $buildings = Auth::user()->planets()->first()->buildingsOfType('shipyard');

        return view('player.shipyard', compact('buildings'));
    }
}
