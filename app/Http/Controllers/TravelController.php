<?php

namespace App\Http\Controllers;

use App\GlobalRate;
use App\Http\Requests\TravelRequest;
use App\Jobs\TravelCompleted;
use App\Planet;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function time(Planet $origin, Planet $destination)
    {
        $loc1 = $origin->SolarSystem()->first()->location;
        $loc2 = $destination->SolarSystem()->first()->location;
        $x1 = $loc1[0];
        $y1 = $loc1[1];
        $x2 = $loc2[0];
        $y2 = $loc2[1];

        $dx = ($x2 - $x1) * ($x2 - $x1);
        $dy = ($y2 - $y1) * ($y2 - $y1);

        $minutes = 720; // 1 days
        $base_distance = 400;
        $rate = $minutes / $base_distance;

        $time_distance = ceil((sqrt($dx + $dy) * $rate));

        return intval($time_distance / GlobalRate::getGlobalTravelSpeed()) + 5;
    }

    public function formattedTime(Planet $origin, Planet $destination)
    {
        $minutes = $this->time($origin, $destination);
        if ($minutes > 60) {
            $hours = floor($minutes / 60);
        } else {
            return $minutes . " Minutes";
        }
        if ($hours > 24) {
            $days = floor($hours / 24);
        } else {
            return $hours . ' Hours, ' . ((int)$minutes % 60) . " Minutes";
        }
        return $days . 'Days, ' . $hours . ' Hours, ' . $minutes % 60 . " Minutes";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Planet $planet
     * @return \Illuminate\Http\Response
     */
    public function create(Planet $planet)
    {
        return view('content.launch-attack', compact('planet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fleet = explode(",", $request->fleet);
        $fleets = json_decode($request->fleets);
        $time = $this->time(Planet::find($request->origin), Planet::find($request->destination));
        $travel = new Travel();
        $travel->type = 'attacking';
        $travel->from_planet_id = $request->origin;
        $travel->to_planet_id = $request->destination;
        $travel->fleet = $request->fleet;
        $travel->departure = Carbon::now();
        $travel->arrival = Carbon::now()->addMinutes($time);
        $travel->save();

        for($i = 0; $i < count($fleets); $i++) {
            $ship = Planet::find($request->origin)->fleet($fleets[$i]->description->name)->first();
            $ship->count = $ship->count - intVal($fleet[$i]);
            $ship->save();
        }

        dispatch((new TravelCompleted($travel))->delay(Carbon::now()->addMinutes($time)));

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }
}
