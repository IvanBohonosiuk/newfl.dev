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
        $author = $event->user();

        $author->notify(new AddProjects($event->project(), $event->user()));
    }
}
