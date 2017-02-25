<?php

namespace App\Http\Controllers;

use App\planet;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function planets(Request $request){
        return $request->user()->planets()->get();
    }

    public function resources(Planet $planet){
        $planets = $planet->buildings()->get()->groupBy('BuildingPrototype.type');
        return $planets['resource'];
    }
}
