<?php

namespace App\Http\Controllers;

use App\Building;
use App\Jobs\UpgradeBuilding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    /**
     * Display a listing of the buildings.
     *
     * @param $type type of building
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $planets = Auth::user()->planets()->get();
        return view('content.building-view', compact('planets', 'type'));
    }

    /**
     * Show the form for creating a new building.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created building in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified building.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified building.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified building in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * upgrade the specified building in storage.
     *
     * @param  \App\Building  $building
     */
    public function upgrade(Building $building)
    {
        if($building->upgradeable()){
            $building->setUpgrading(true);
            dispatch((new UpgradeBuilding($building, Auth::user()->id))->delay(Carbon::now()->addMinutes($building->upgradeTime())));
        }
    }

    /**
     * Remove the specified building from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }
}