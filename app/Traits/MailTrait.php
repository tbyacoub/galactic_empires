<?php

namespace App\Traits;

trait MailTrait
{

    public function incomingMail()
    {
        return $this->hasMany('App\Mail', 'receiver_id');
    }

    public function outgoingMail()
    {
        return $this->hasMany('App\Mail', 'sender_id');
    }

    public function unReadMail()
    {
        return $this->incomingMail()
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
