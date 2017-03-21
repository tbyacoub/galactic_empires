<?php

namespace App\Traits;

trait MailTrait
{

    /**
     * Returns all incoming mail for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingMail()
    {
        return $this->hasMany('App\Mail', 'receiver_id');
    }

    /**
     * Returns all outgoing mail for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outgoingMail()
    {
        return $this->hasMany('App\Mail', 'sender_id');
    }

    /**
     * Returns all unread mail for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unReadMail()
    {
        return $this->incomingMail()
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
