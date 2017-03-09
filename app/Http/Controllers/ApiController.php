<?php

namespace App\Http\Controllers;

use App\planet;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
    * @return All planets associated with a given user
    */
    public function planets(Request $request){
        return $request->user()->planets()->get();
    }

    /**
    * @return All facility buildings associated with a given planet
    */
    public function facilities(Planet $planet){
        return $planet->buildings()->where('type', 'facility')->with('upgrades')->get();
    }

    /**
    * @return All resources buildings associated with a given planet
    */
    public function resources(Planet $planet){
        return $planet->buildings()->where('type', 'resource')->with('upgrades')->get();
    }

    /**
    * @return All planetary defense buildings associated with a given planet
    */
    public function planetaryDefenses(Planet $planet){
        return $planet->buildings()->where('type', 'planetary_defense')->with('upgrades')->get();
    }
}
