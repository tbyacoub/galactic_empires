<?php

namespace App;

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

}