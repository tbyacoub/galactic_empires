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

/**
 * Class BuildingViewController
 * @package App\Http\Controllers
 */
class BuildingViewController extends Controller
{

    /**
     * Returns resources page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexResources(Request $request){
        return $this->index('resources', $request);
    }

    /**
     * Returns facilities page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexFacilities(Request $request){
        return $this->index('facilities', $request);
    }

    /**
     * Returns planetary defences page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexDefenses(Request $request){
        return $this->index('planetary_defenses', $request);
    }

    /**
     * Returns a the view corresponding to the given building type
     *
     * @param $type Building type
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function index($type, Request $request){
        $planets = $request->user()->planets()->get();
        return view('content.building-view', compact('planets', 'type'));
    }


    /**
     * Upgrades the given building
     *
     * @param Request $request
     * @param $id ID of building
     * @return int Building ID if successful, else 0
     */
    public function upgradeBuilding(Request $request, $id){

        if($this->canUpgrade($id)){
            // Subtract resources

            // Set to upgrading
            DB::table('building_planet')
                ->where('id', strval($id))
                ->update(['is_upgrading' => true]);

            // Dispatch delayed upgrade Job.
            $job = (new UpgradeBuilding($id, Auth::user()->id))->delay(Carbon::now()->addMinutes($this->calculateUpgradeTime($id)));
            dispatch($job);
            return $id;
        }else{
            return 0;
        }
    }

    /**
     * Determines whether or not a given building can be upgraded
     *
     * @param $id ID of building
     * @return bool True if the building is below the max level, else false
     */
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


    /**
     * Calculates the upgrade time for the given building
     * @param $id Building to upgrade
     * @return int Upgrade time
     */
    private function calculateUpgradeTime($id){
        return 1;
    }



}
