<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| User Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/*
|--------------------------------------------------------------------------
| Organization Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('organization.{organizationId}', function ($user, $organizationId) {
    if (! $user) {
        return false;
    }

    return (int) $user->organization_id === (int) $organizationId;
});

/*
|--------------------------------------------------------------------------
| Module Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('module.{module}', function ($user, $module) {
    return true;
});

/*
|--------------------------------------------------------------------------
| Default Laravel Notification Channel
|--------------------------------------------------------------------------
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
