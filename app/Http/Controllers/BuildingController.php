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

    /**
     * Returns resources view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexResources(Request $request){
        return $this->index('resources', $request);
    }

    /**
     * Returns facilities view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexFacilities(Request $request){
        return $this->index('facilities', $request);
    }

    /**
     * Returns defense view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexDefenses(Request $request){
        return $this->index('planetary_defenses', $request);
    }

    /**
     * Returns research view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexResearch(Request $request){
        return $this->index('research', $request);
    }

    /**
     * Returns shipyard view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexShipyard(Request $request){
        return $this->index('shipyard', $request);
    }

    /**
     * Returns desired view with planets, and type data.
     *
     * @param $type view type
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function index($type, Request $request){
        $planets = $request->user()->planets()->get();
        return view('content.building-view', compact('planets', 'type'));
    }

    /**
     * Upgrades givin building by calling UpgradeBuilding job.
     *
     * @param Building $building
     */
    public function upgrade(Building $building)
    {
        if($building->upgradeable()){
            $building->setUpgrading(true);
            $building->decrementBuildingCost();
            dispatch((new UpgradeBuilding($building, Auth::user()->id))->delay(Carbon::now()->addMinutes($building->upgradeTime())));
        }else{
            return "false";
        }
    }

    public function cost(Building $building)
    {
        return $building->getFormattedBuildingCost();
    }

}
