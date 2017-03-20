<?php

namespace App\Http\Controllers;

use App\GlobalRate;
use App\Http\Requests\GameSettingsUpdateRequest;
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
        $globals = \App\GlobalRate::first()->get();

        return view('admin.game-settings', compact('globals'));
    }

    /**
     * Submit a new post.
     *
     * @param Request $request
     *
     * @return $this->index()
     */
    public function store(GameSettingsUpdateRequest $request)
    {

        GlobalRate::updateGlobals($request->all());

        return redirect('admin/game-settings');
    }

}
