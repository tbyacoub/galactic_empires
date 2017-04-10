<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

/*
 * Authenticate the user's personal channel...
 */
Broadcast::channel('App.User.*', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('received.email.*', function ($user, $user_id) {
   if($user->id == $user_id) {
       return true;
   }
   return false;
});

Broadcast::channel('received.notification.*', function ($user, $user_id) {
    if($user->id == $user_id) {
        return true;
    }
    return false;
});

Broadcast::channel('building.upgraded.*', function ($user, $user_id) {
    if($user->id == $user_id){
        return true;
    }
    return false;
});

Broadcast::channel('travel.status.*', function ($user, $user_id) {
    if($user->id == $user_id){
        return true;
    }
    return false;
});