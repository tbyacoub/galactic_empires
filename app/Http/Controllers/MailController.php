<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Mail;
use App\User;
use Illuminate\Http\Request;

class MailController extends Controller
{

    /**
     * Returns inbox view with all mail data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = "inbox";
        $mails = $request->user()->incomingMail()
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->paginate(15);
        $items = json_encode($mails->items());
        return view('mail.inbox', compact('mails', 'items', 'page'));
    }

    /**
     * Returns sent mail view with sent mail data.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sentIndex(Request $request)
    {
        $page = "sent";
        $mails = $request->user()->outgoingMail()
            ->orderBy('created_at', 'desc')
            ->with('receiver')
            ->paginate(15);
        return view('mail.sent', compact('mails', 'page'));
    }

    /**
     * Returns a compose view.
     *
     * @param Request $request
     * @param null $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request, $email = null)
    {
        $page = "create";
        if($email != null)
        {
            $request->session()->flash('email', $email);
        }
        return view('mail.create', compact('page'));
    }

    /**
     * Returns a forward mail view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forward(Request $request)
    {
        $page = "forward";
        $mail = Mail::find($request->mailId);
        $forwardMessage = 'sent by' . $mail->sender()->first()->email . "\n\n\"" . $mail->message . "\"";
        $request->session()->flash('message', $forwardMessage);
        return view('mail.create', compact('page'));
    }

    /**
     * Creates a new mail and sends it.
     *
     * @param MailRequest $mailRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
        event(new \App\Events\EmailSentEvent($receiver->id));
        return redirect('/mail');
    }

    /**
     * Returns a specific mail view.
     *
     * @param Mail $mail
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Mail $mail, Request $request)
    {
        $page = "show";
        if($mail->receiver_id != $request->user()->id){
            return back();
        }
        $mail->setRead(true);
        return view('mail.show', compact('mail', 'page'));
    }

    /**
     * Deletes a mail.
     *
     * @param Mail $mail
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Mail $mail, Request $request)
    {
        if($mail->receiver_id != $request->user()->id)
        {
            return back();
        }
        $mail->delete();
        return redirect('/mail');
    }

    /**
     * Gets mail notifications.
     *
     * @param Request $request
     * @return array
     */
    public function getUserNotifications(Request $request)
    {
        $data = [];
        $mails = $request->user()->unReadMail()->take(5);
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

    /**
     * Mail api used to set read, favorite, delete.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailApi(Request $request)
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
