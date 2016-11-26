<?php

namespace App\Listeners;

use App\Contracts\ProjectsContract;
use App\Events\NewProject;
use App\Notifications\AddProjects;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class NotifyAboutProject
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewProject  $event
     * @return void
     */
    public function handle(NewProject $event)
    {
//        $freelancers = $event->freelancers();


//        $pusher = new \Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), config('broadcasting.connections.pusher.options'));
//
//        /* Your data that you would like to send to Pusher */
//        $data = ['project' => $event->project(), 'user' => $event->user()];
//
//        /* Sending the data to channel: "test_channel" with "my_event" event */
//        $pusher->trigger( 'chat-room.1', $event, $data);

        \Notification::send(Auth::user(), new AddProjects($event->project(), $event->user()));

//        $author->notify(new AddProjects($event->project(), $event->user()));
    }
}
