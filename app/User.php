<?php

namespace App;

use App\Traits\MailTrait;
use App\Traits\OwnesPlanetTrait;
use App\Traits\NotificationTrait;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use MailTrait;
    use EntrustUserTrait;
    use OwnesPlanetTrait;
    use NotificationTrait;

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

}
