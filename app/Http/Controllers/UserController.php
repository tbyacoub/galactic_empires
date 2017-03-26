<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $users = User::paginate(20);
            return view('admin.players-list', compact('users'));
        }
        return back();
    }

    /**
     * All planets associated with a given user
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planets(User $user)
    {
        return $user->planets()->with('fleets')->get();
    }

    public function mails(User $user)
    {
        $data = [];
        $mails = $user->unReadMail()->take(5);
        foreach ($mails as $mail) {
            array_push($data, [
                "id" => $mail->id,
                "sender" => $mail->sender()->first()->name,
                "subject" => $mail->subject,
                "created_at" => $mail->getCreatedAt()
            ]);
        }
        return $data;
    }

    public function notifications(User $user)
    {
        $data = [];
        $notifications = $user->unReadNotifications()->take(5);
        foreach ($notifications as $notification) {
            array_push($data, [
                "subject" => $notification->subject,
                "created_at" => $notification->getCreatedAt()
            ]);
        }
        return $data;
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->hasRole('admin')) {
            return view('admin.edit-player', compact('user'));
        }
        return back();
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
