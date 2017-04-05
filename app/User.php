<?php

namespace App;

use App\Traits\MailTrait;
use App\Traits\OwnesPlanetTrait;
use App\Traits\NotificationTrait;
use Illuminate\Database\Eloquent\Collection;
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

    public function completeTutorial(){
        $this->tutorial_complete = 1;
        $this->save();
    }

    public function fromTravelsAllPlanets(){
        $from_travels = new Collection();
        $planets = $this->planets()->get();
        foreach ($planets as $planet){
           $from_travels = $from_travels->merge($planet->fromTravels()->get());
        }

        return $from_travels;
    }

    public function toTravelsAllPlanets(){
        $to_travels = new Collection();
        $planets = $this->planets()->get();
        foreach ($planets as $planet){
            $to_travels = $to_travels->merge($planet->toTravels()->get());
        }

        return $to_travels;
    }

}
