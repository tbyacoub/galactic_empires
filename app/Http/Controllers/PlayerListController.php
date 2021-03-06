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

    /**
     * Returns admin view of player liar
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.players-list', compact('users'));
    }

}
