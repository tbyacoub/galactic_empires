<?php

namespace App\Http\Controllers;

use App\Events\NotificationReceivedEvent;
use Illuminate\Http\Request;
use App\User;
use App\Planet;
use App\Notification;
use Illuminate\Support\Facades\Auth;

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
    public function modifyMetal(Planet $planet, Request $request){
        $amount = $request->all()['amount'];

        $value = $planet->metal() + $amount;
        $value = ($planet->metal() + $amount < 0) ? 0 : min($value, $planet->metal_storage) ;

        $planet->setResources($value, $planet->crystal(), $planet->energy());

        $notification = new Notification();
        $notification->sendResourceModifiedNotification(Auth::user()->name, $planet->user()->first()->id, $planet->name, $amount);

        return back();
    }

    /**
     * Modifies the resources on a given planet
     * @param $planet_id ID of planet to modify
     * @param Request $request
     */
    public function modifyCrystal(Planet $planet, Request $request){
        $amount = $request->all()['amount'];

        $value = $planet->crystal() + $amount;
        $value = ($planet->crystal() + $amount < 0) ? 0 : min($value, $planet->crystal_storage) ;

        $planet->setResources($planet->metal(), $value, $planet->energy());

        $notification = new Notification();
        $notification->sendResourceModifiedNotification(Auth::user()->name, $planet->user()->first()->id, $planet->name, $amount);

        return back();
    }

    /**
     * Modifies the resources on a given planet
     * @param $planet_id ID of planet to modify
     * @param Request $request
     */
    public function modifyEnergy(Planet $planet, Request $request){
        $amount = $request->all()['amount'];

        $value = $planet->energy() + $amount;
        $value = ($planet->energy() + $amount < 0) ? 0 : min($value, $planet->energy_storage) ;

        $planet->setResources($planet->metal(), $planet->crystal(), $value);

        $notification = new Notification();
        $notification->sendResourceModifiedNotification(Auth::user()->name, $planet->user()->first()->id, $planet->name, $amount);

        return back();
    }
}
