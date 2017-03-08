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
        return $planet->buildings()->with('description')->whereHas('description', function($description){
            $description->where('type', 'facility');
        })->get();
    }

    public function resources(Planet $planet){
        return $planet->buildings()->with('description')->whereHas('description', function($description){
            $description->where('type', 'resource');
        })->get();
    }

    public function planetaryDefenses(Planet $planet){
        return $planet->buildings()->with('description')->whereHas('description', function($description){
            $description->where('type', 'planetary_defense');
        })->get();
    }
}
