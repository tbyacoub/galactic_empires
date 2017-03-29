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
    use OwnesPlanetTrait;
    use NotificationTrait;
    use EntrustUserTrait {
        can as entrustCan;
    }

    /**
     * overriding function to resolve conflects between entrust and laravel authrization.
     * Use entrustCan for entrust can function.
     *
     * @param string $ability
     * @param array $arguments
     * @return bool|mixed
     */
    public function can($ability, $arguments = [])
    {
        return parent::can($ability, $arguments);
    }

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
