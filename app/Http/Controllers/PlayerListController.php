<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin.player-list');
    }

}
