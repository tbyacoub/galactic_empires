<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildingViewController extends Controller
{

    public function indexResources(Request $request){
        return $this->index('resources', $request);
    }

    public function indexFacilities(Request $request){
        return $this->index('facilities', $request);
    }

    public function indexDefenses(Request $request){
        return $this->index('planetary_defenses', $request);
    }

    private function index($type, Request $request){
        $planets = $request->user()->planets()->get();
        return view('content.building-view', compact('planets', 'type'));
    }
    
    private function upgradeBuilding(Request $request, $id){

    }
}
