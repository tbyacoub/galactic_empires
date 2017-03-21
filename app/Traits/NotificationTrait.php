<?php
/**
 * Created by PhpStorm.
 * User: tbyacoub
 * Date: 3/18/17
 * Time: 8:07 PM
 */

namespace App\Traits;


trait NotificationTrait
{

    /**
     * Returns all notifications for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * Returns all unread mail for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unReadNotifications()
    {
        return $this->notifications()
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->get();
    }

}