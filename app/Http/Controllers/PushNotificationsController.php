<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:push-notification');
    }

    public function index()
    {
        return view('admin.push-notifications');
    }

}
