<?php

namespace App\Http\Controllers;

use App\Building;
use App\Events\BuildingHasUpgradedEvent;
use App\Events\EmailSentEvent;
use Carbon\Carbon;
use App\Jobs\UpgradeBuilding;
use Illuminate\Support\Facades\DB;
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
    
    public function upgradeBuilding(Request $request, $id){

        if($this->canUpgrade($id)){
            // Set to upgrading



            // Dispatch delayed upgrade Job.
            $job = (new UpgradeBuilding($id))
                ->delay(Carbon::now()->addMinutes($this->calculateUpgradeTime($id)));
            dispatch($job);

            event(new BuildingHasUpgradedEvent($id));
            return 1;
        }else{
            return 0;
        }
    }

    private function canUpgrade($id){
        return true;
    }

    private function calculateUpgradeTime($id){
        return 0;
    }

}
