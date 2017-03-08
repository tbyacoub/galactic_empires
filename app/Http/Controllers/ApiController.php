<?php

namespace App\Http\Controllers;

use App\planet;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function planets(Request $request){
        return $request->user()->planets()->get();
    }

    public function facilities(Planet $planet){
        return $planet->buildings()->where('type', 'facility')->with('upgrades')->get();
    }

    public function resources(Planet $planet){
        return $planet->buildings()->where('type', 'resource')->with('upgrades')->get();
    }

    public function planetaryDefenses(Planet $planet){
        return $planet->buildings()->where('type', 'planetary_defense')->with('upgrades')->get();
    }
}
