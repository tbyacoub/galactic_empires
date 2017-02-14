<?php

namespace App;

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

    public function getCreatedAt($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function sender()
    {
        return $this->belongsTo('App\User');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User');
    }

    public function isRead()
    {
        return $this->read;
    }

    public function setRead($read)
    {
        $this->read = $read;
        $this->save();
    }

    public function isFavorite()
    {
        return $this->favorite;
    }

    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
        $this->save();
    }
}
