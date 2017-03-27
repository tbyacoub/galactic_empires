<?php

namespace App;

use App\Events\NotificationReceivedEvent;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'content', 'read'
    ];

    /**
     * Returns how long ago was the mail created.
     *
     * @return date
     */
    public function getCreatedAt()
    {
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Return whether the notification was read or not.
     *
     * @return boolean
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * Sets the notification read status to read
     *
     * @param $read boolean
     */
    public function setRead($read)
    {
        $this->read = $read;
        $this->save();
    }

    public function sendResourceModifiedNotification($from_name, $to_id, $planet_name, $amount){
        $this->subject = "Resources Modified";
        $this->content = $from_name . " has modified Planet: " . $planet_name ."'s".
            " metal by amount : " . $amount;
        $this->read = false;
        $this->user()->associate($to_id);
        $this->save();
        event(new NotificationReceivedEvent($to_id));
    }

    public function sendAttackNotificationToDefender(Travel $travel){
        $this->subject = "You're are under attack.";
        $this->content = $travel->fromPlanet()->first()->user()->first()->name . ' has Launched an Attack'
            . ' on ' . $travel->toPlanet()->first()->name . ' \nGo to home page to view the status.';
        $this->read = false;
        $this->user()->associate($travel->toPlanet()->first()->user()->first()->id);
        $this->save();

    }

    public function sendFleetHasReturnedNotification(Travel $travel){
        $this->subject = "You're fleet has returned to " . $travel->toPlanet()->first()->name . '.';
        $this->content = "Returned from Planet " . $travel->fromPlanet()->first()->name . '. \n'
            . 'Your attack has gained ' . $travel->metal . ' Metal, ' . $travel->crystal
            . ' Crystal and ' . $travel->energy . ' Energy.';
        $this->read = false;
        $this->user()->associate($travel->fromPlanet()->first()->user()->first()->id);
        $this->save();
    }

}