<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailApiRequest;
use App\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{

    public function index(Request $request)
    {
        $mails = $request->user()->incomingMail()
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->paginate(15);
        $items = json_encode($mails->items());
        return view('mail.index', compact('mails', 'items'));
    }

    public function sentIndex()
    {
        return view('mail.index');
    }

    public function create()
    {
        return view('mail.create');
    }

    public function store()
    {

    }

    public function show(Mail $mail, Request $request)
    {
        if($mail->receiver_id != $request->user()->id){
            return back();
        }
        $mail->setRead(true);
        return view('mail.show', compact('mail'));
    }

    public function destroy(Mail $mail)
    {
        $mail->delete();
    }

    public function destroyAll(Request $request)
    {
        $mails = Mail::find($request->checked);
        foreach($mails as $mail)
        {
            $mail->delete();
        }
    }

    public function getUserNotifications(Request $request)
    {
        return $request->user()->incomingMail()
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->get();
    }

    public function mailApi(MailApiRequest $request)
    {
        $mails = Mail::find($request->checked);
        foreach($mails as $mail)
        {
            switch ($request->input('method'))
            {
                case 'read':
                    $mail->setRead(true);
                    break;
                case 'un-read':
                    $mail->setRead(false);
                    break;
                case 'favorite':
                    $mail->setFavorite(true);
                    break;
                case 'un-favorite':
                    $mail->setFavorite(true);
                    break;
                case 'delete':
                    $mail->delete();
                    break;

            }
        }
        return back();
    }
}
