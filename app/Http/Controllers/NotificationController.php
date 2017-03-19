<?php

namespace App\Http\Controllers;

use App\Jobs\DestroyNotifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Returns inbox view with all mail data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->get();
        dispatch(new DestroyNotifications($notifications));
        return view('content.notification-index', compact('notifications'));
    }

    /**
     * Gets notifications.
     *
     * @param Request $request
     * @return array
     */
    public function getUserNotifications(Request $request)
    {
        $data = [];
        $notifications = $request->user()->unReadNotifications()->take(5);
        foreach ($notifications as $notification) {
            array_push($data, [
                "subject" => $notification->subject,
                "created_at" => $notification->getCreatedAt()
            ]);
        }
        return $data;
    }
}
