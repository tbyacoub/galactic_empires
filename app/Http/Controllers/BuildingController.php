<?php

namespace App\Http\Controllers;

use App\Building;
use App\Events\BuildingHasUpgradedEvent;
use App\Events\EmailSentEvent;
use Carbon\Carbon;
use App\Jobs\UpgradeBuilding;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
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

    public function upgrade(Building $building)
    {
        if(!$building->isUpgrading()){
            $building->setUpgrading(true);
            dispatch((new UpgradeBuilding($building, Auth::user()->id))->delay(Carbon::now()->addMinutes($building->upgradeTime())));
        }
    }

}
