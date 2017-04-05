<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanetController extends Controller
{
    /**
     * Display a listing of the planets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planets = Auth::user()->planets()->get();
        return view('planet_overview_view', compact('planets'));
    }

    /**
     * Returns a collection of buildings of type $type, that are associated with $planet.
     *
     * @param Planet $planet
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function buildings(Planet $planet, $type)
    {
        return $planet->buildingsOfType($type)->get();
    }

    /**
     * Returns a collection of fleets, that are associated with $planet.
     *
     * @param Planet $planet
     * @return \Illuminate\Http\Response
     */
    public function fleets(Planet $planet)
    {
        return $planet->fleets()->with('description', 'product')->get();
    }

    /**
     * Show the form for creating a new planet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created planet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified planet.
     *
     * @param  \App\Planet  $planet
     * @return \Illuminate\Http\Response
     */
    public function show(Planet $planet)
    {
        return view('content.planet_view', compact('planet'));
    }

    /**
     * Show the form for editing the specified planet.
     *
     * @param  \App\Planet  $planet
     * @return \Illuminate\Http\Response
     */
    public function edit(Planet $planet)
    {
        //
    }

    /**
     * Update the specified planet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Planet  $planet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planet $planet)
    {
        //
    }

    public function updateResource(Planet $planet, Request $request, $resource)
    {
        $amount = $request->amount;
        switch ($resource){
            case "metal":
                $planet->modifyMetal($amount);
                break;
            case "crystal":
                $planet->modifyCrystal($amount);
                break;
            case "energy":
                $planet->modifyEnergy($amount);
                break;
        }
        $notification = new Notification();
        $notification->sendResourceModifiedNotification(Auth::user()->name, $planet->user()->first()->id, $planet->name, $amount);
        return back();
    }

    /**
     * Remove the specified planet from storage.
     *
     * @param  \App\Planet  $planet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planet $planet)
    {
        $planet->delete();
    }
}
