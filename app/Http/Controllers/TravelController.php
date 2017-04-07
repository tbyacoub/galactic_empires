<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequest;
use App\Jobs\TravelCompleted;
use App\Planet;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        //
    }

    public function formattedTime(Planet $origin, Planet $destination)
    {
        $minutes = Travel::time($origin, $destination);
        return Carbon::now()->addMinutes($minutes)->diffForHumans();
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

        $time = Travel::time(Planet::find($request->origin), Planet::find($request->destination));

        $travel = new Travel([
            'type' => 'attacking',
            'from_planet_id' => $request->origin,
            'to_planet_id' => $request->destination,
            'fleet' => $fleet,
            'departure' => Carbon::now(),
            'arrival' => Carbon::now()->addMinutes($time),
        ]);
        $travel->save();

        dispatch((new TravelCompleted($travel))->delay(Carbon::now()->addMinutes($time)));

        for($i = 0; $i < count($fleets); $i++) {
            $ship = Planet::find($request->origin)->fleet($fleets[$i]->description->name)->first();
            $ship->count = $ship->count - intVal($fleet[$i]);
            $ship->save();
        }

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
