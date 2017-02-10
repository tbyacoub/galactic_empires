<?php

namespace App\Http\Controllers;

use App\User;

class PlayerListController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:view-players-list');
    }

    public function index()
    {
        $all = User::all();
        $users = array();

        foreach($all as $user){
            $roles = $user->cachedRoles();
            foreach($roles as $r){
                $role = $r->display_name;
            }

            $user->role = $role;
            array_push($users, $user);
        }

        return view('admin.players-list', compact('users'));
    }

}
