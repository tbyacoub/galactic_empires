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
     * Get the created at value.
     *
     * @return String date created
     */
    public function getCreatedAt()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get the User Model of the Sender of this Mail.
     *
     * @return User sender of this Mail.
     */
    public function sender()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the User Model of the Receiver of this Mail.
     *
     * @return User receiver of this Mail.
     */
    public function receiver()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the boolean value if this Mail has been read.
     *
     * @return integer 1, if it has been read, 0 otherwise
     */
    public function isRead()
    {
        return $this->read;
    }


    /**
     * Set this Mail to has been read.
     *
     * @param $read integer, set 1 to set it to has been read.
     */
    public function setRead($read)
    {
        $this->read = $read;
        $this->save();
    }

    /**
     * Get the int(bool) value if this Mail is marked as Favorite.
     *
     * @return integer, 1 if it is set to favorite, 0 otherwise.
     */
    public function isFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set this Mail to favorite.
     *
     * @param $favorite integer, set to 1 to mark as favorite.
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
        $this->save();
    }
}
