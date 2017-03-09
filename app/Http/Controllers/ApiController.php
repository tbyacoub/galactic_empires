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
        return $planet->facilitiesBuildings();
    }

    public function resources(Planet $planet){
        return $planet->resourcesBuildings();
    }

    public function planetaryDefenses(Planet $planet){
        return $planet->planetaryDefensesBuildings();
    }
}
