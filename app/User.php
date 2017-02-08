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

    public function incomingMessages()
    {
        return $this->hasMany('App\PrivateMessage', 'receiver_id');
    }

    public function outgoingMessages()
    {
        return $this->hasMany('App\PrivateMessage', 'sender_id');
    }
}
