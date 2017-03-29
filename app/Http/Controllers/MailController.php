<?php

namespace App\Http\Controllers;

use App\Mail;
use App\User;
use Illuminate\Http\Request;
use App\Events\EmailSentEvent;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    /**
     * Display a listing of the received mail.
     *
     * @param $box
     * @return \Illuminate\Http\Response
     */
    public function index($box)
    {
        if($box == "inbox") {
            return $this->inbox($box);
        } else {
            return $this->sent($box);
        }
    }

    private function inbox($page)
    {
        $mails = Auth::user()->incomingMail()
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->paginate(15);
        $items = json_encode($mails->items());
        return view('mail.inbox', compact('mails', 'items', 'page'));
    }

    private function sent($page)
    {
        $mails = Auth::user()->outgoingMail()
            ->orderBy('created_at', 'desc')
            ->with('receiver')
            ->paginate(15);
        return view('mail.sent', compact('mails', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mail.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MailRequest $mailRequest
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $mailRequest)
    {
        $receiver = User::where('email', $mailRequest->email)->first();
        $mail = new Mail([
            "subject" => $mailRequest->subject,
            "message" => $mailRequest->message,
            "read" => 0,
            "favorite" => 0,
        ]);
        $mail->sender()->associate($mailRequest->user());
        $mail->receiver()->associate($receiver);
        $mail->save();
        event(new EmailSentEvent($receiver->id));
        return redirect('/mail/sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        if(Auth::user()->can('view', $mail)) {
            $page = "show";
            $mail->setRead(true);
            return view('mail.show', compact('mail', 'page'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        if(Auth::user()->can('delete', $mail)) {
            $mail->delete();
        }
        return redirect('/mail/inbox');
    }

    /**
     * Mail api used to set read, favorite, delete.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function collection(Request $request)
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
                    $mail->setFavorite(false);
                    break;
                case 'delete':
                    $mail->delete();
                    break;
            }
        }
    }

    /**
     * Returns a forward/reply mail view depending of _CMETHOD input field.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createWParam(Request $request)
    {
        $mail = Mail::find($request->mailId);

        if($request->_CMETHOD == "FORWARD"){
            $forwardMessage = 'sent by' . $mail->sender()->first()->email . "\n\n\"" . $mail->message . "\"";
            $request->session()->flash('message', $forwardMessage);
        } else {
            $request->session()->flash('email', $mail->sender()->first()->email);
        }
        return $this->create();
    }
}
