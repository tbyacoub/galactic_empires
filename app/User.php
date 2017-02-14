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


    /**
     * @return User Planets
     */
    public function planets()
    {
        return $this->hasMany('App\Planet');
    }


    public function planetsCount(){
        return count($this->planets()->get());
    }

    /**
     * Sum of all planet's metal belonging to this User.
     *
     * @return integer
     */
    public function metal(){
        return $this->userResourcesTotal()['metal'];
    }

    /**
     * Sum of all planet's wood belonging to this User.
     *
     * @return integer
     */
    public function wood(){
        return $this->userResourcesTotal()['wood'];
    }

    /**
     * Sum of all planet's energy belonging to this User.
     *
     * @return integer
     */
    public function energy(){
        return $this->userResourcesTotal()['energy'];
    }

    /**
     * Get the total sum of all user resources as an array.
     *
     * @return array
     */
    public function userResourcesTotal()
    {
        $total = ['metal' => 0, 'energy' => 0, 'wood' => 0];
        $planets = $this->planets()->get();
        foreach ($planets as $planet) {
            $total['metal'] += $planet->metal();
            $total['wood'] += $planet->wood();
            $total['energy'] += $planet->energy();
        }
        return $total;
    }

    public function addPlanet(Planet $planet)
    {
        $planet->user_id = $this->userId;
        return $this->planets()->save($planet);
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
