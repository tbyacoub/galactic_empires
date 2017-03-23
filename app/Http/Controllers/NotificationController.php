<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyNotifications;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = Auth::user()->notifications()->get();
        dispatch(new DestroyNotifications($notifications));
        return view('content.notification-index', compact('notifications'));
    }
}
