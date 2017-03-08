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
            // Subtract resources

            // Set to upgrading
            DB::table('building_planet')
                ->where('id', strval($id))
                ->update(['is_upgrading' => true]);

            // Dispatch delayed upgrade Job.
            $job = (new UpgradeBuilding($id, Auth::user()->id))
                ->delay(Carbon::now()->addMinutes($this->calculateUpgradeTime($id)));
            dispatch($job);
            return $id;
        }else{
            return 0;
        }
    }

    private function canUpgrade($id){
        $can_upgrade = true;

        // Get current level.
        $pivot = DB::table('building_planet')
            ->select('current_level', 'building_id')
            ->where('id', strval($id))->first();
        $level =  $pivot->current_level;

        // Get max level for this type of building.
        $upgrade = DB::table('upgrades')
            ->select('max_level')
            ->where('upgradeable_id', strval($pivot->building_id))->first();
        $max_level = $upgrade->max_level;

        // Make sure it isn't already max level.
        if($level == $max_level){
            $can_upgrade = false;
        }

        return $can_upgrade;
    }

    private function calculateUpgradeTime($id){
        return 1;
    }



}
