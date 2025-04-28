<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.status.{id}', function ($user, $id) {
    // return (int) $user->id === (int) $id;
    return true;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
    // return (int) $user->id === (int) $id;
    return true;
});
