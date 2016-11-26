<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.User.*', function ($user, $userId) {
//            \Debugbar::disable();
            return (int) $user->id === (int) $userId;
        });

//        Broadcast::channel('chat-room.*', function ($user, $chatroomId) {
//            Debugbar::disable();
//            // return whether or not this current user is authorized to visit this chat room
//            if ($user->id == $chatroomId) { // Replace with real ACL
//                return true;
//            }
//
//            return false;
//        });

        Broadcast::channel('chat-room.*', function ($user, $roomId) {
//            \Debugbar::disable();
//            if ((int) $user->id === (int) $roomId) { // Replace with real authorization
                return [
                    'id' => $user->id,
                    'name' => $user->name
                ];
//            }
        });
    }
}
