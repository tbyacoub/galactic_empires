<?php

namespace App\Http\Controllers;

use App\PrivateMessage;
use App\User;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id', 'receiver_id', 'subject', 'message', 'read', 'favorite'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sender_id', 'receiver_id',
    ];

    public function index(Request $request)
    {
        $messages = $request->user()->incomingMessages()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('inbox', compact('messages'));
    }

    public function getUserNotifications(Request $request)
    {
        return $request->user()->incomingMessages()
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->get();
    }

    public function getPrivateMessages(Request $request)
    {
        return $request->user()->incomingMessages()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPrivateMessageById(PrivateMessage $privateMessage)
    {
        // check if user is the receiver
        if($privateMessage->receiver()->first()->id != request()->user()->id)
            return "Cannot access this message";
        // If message is not read, change the read to 1
        if(!$privateMessage->isRead()) {
            $privateMessage->setRead(1);
            $privateMessage->save();
        }
        return $privateMessage;
    }

    public function getPrivateMessageSent(Request $request)
    {
        return $request->user()->outgoingMessages()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function sendPrivateMessage(Request $request)
    {
        $privateMessage = new PrivateMessage();
        $privateMessage->sender_id = $request->sender_id;
        $privateMessage->receiver_id = $request->receiver_id;
        $privateMessage->subject = $request->subject;
        $privateMessage->message = $request->message;
        $privateMessage->read = 0;
        $privateMessage->save();
    }
}
