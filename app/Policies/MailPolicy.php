<?php

namespace App\Policies;

use App\User;
use App\Mail;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mail.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function view(User $user, Mail $mail)
    {
        return $mail->receiver()->first()->id === $user->id || $mail->sender()->first()->id === $user->id;
    }

    /**
     * Determine whether the user can create mails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the mail.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function update(User $user, Mail $mail)
    {
        return $mail->receiver()->first()->id === $user->id;
    }

    /**
     * Determine whether the user can delete the mail.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function delete(User $user, Mail $mail)
    {
        return $mail->receiver()->first()->id === $user->id;
    }
}
