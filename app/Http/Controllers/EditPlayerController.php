<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Planet;

class EditPlayerController extends Controller
{

    /**
    * @param $user User to display information
     *
    * @return Admin view with current users information
    */
    public function index(User $user){
        return view('admin/edit-player', compact('user'));
    }


    /**
     * Modifies the resources on a given planet
     * @param $planet_id ID of planet to modify
     * @param Request $request
     */
    public function modifyResource($planet_id, Request $request){
        $r = $request->all();

        // Get the data from the ajax request
        $toAdd = $r['add'];
        $quantity = $r['quantity'];
        $type = $r['type'];
        $q1 = 0; $q2 = 0; $q3 = 0;

        // Check if we are subtracting and negate the quantity.
        if($toAdd == 'false'){
            $quantity = $quantity * -1;
        }

        // Check which type
        if($type == 0) $q1 = $quantity; // metal
        if($type == 1) $q2 = $quantity; // crystal
        if($type == 2) $q3 = $quantity; // energy

        $planet = Planet::find($planet_id);

        $res_array = [
            'metal' => $planet->metal() + $q1,
            'crystal' => $planet->crystal() + $q2,
            'energy' => $planet->energy() + $q3,
        ];

        $resource = $planet->createResource($res_array);

        $val = $planet->update(['resources' => $resource]);

    }


}
