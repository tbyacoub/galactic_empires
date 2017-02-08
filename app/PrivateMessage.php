<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'sender_id', 'receiver_id', 'subject', 'message', 'read'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sender_id', 'receiver_id',
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
        return $this->read == 1;
    }

    public function setRead($read)
    {
        $this->read = $read;
    }


}
