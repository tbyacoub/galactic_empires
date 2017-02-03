<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameSettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:view-game-settings');
    }

    public function index()
    {
        return view('admin.game-settings');
    }

}
