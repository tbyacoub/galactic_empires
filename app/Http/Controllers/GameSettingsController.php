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

    /**
     * Returns the admin view for player settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.game-settings');
    }

}
