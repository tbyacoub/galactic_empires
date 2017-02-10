<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function planets()
    {
        return $this->hasMany('App\Planet');
    }

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
