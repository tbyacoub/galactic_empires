<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'message', 'read', 'favorite'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'receiver_id', 'sender_id'
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

    /**
     * Returns the sender of the this mail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns the receiver od this mail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Return whether the mail was read or not.
     *
     * @return boolean
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * Sets the mail read status to read
     *
     * @param $read boolean
     */
    public function setRead($read)
    {
        $this->read = $read;
        $this->save();
    }

    /**
     * Returns whether the mail is favorited or not.
     *
     * @return boolean
     */
    public function isFavorite()
    {
        return $this->favorite;
    }

    /**
     * Sets the favorite status of mail to favorite.
     *
     * @param $favorite boolean
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
        $this->save();
    }
}
