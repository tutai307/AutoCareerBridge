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
|`  
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('company.{id}', function ($user, $id) {
    return (
        (int) optional($user->company)->id === (int) $id ||
        (int) optional($user->hiring)->company_id === (int) $id ||
        (int) optional($user->university)->id === (int) $id ||
        (int) optional($user->academicAffair)->university_id === (int) $id
    );
}, ['guards' => ['admin']]);

