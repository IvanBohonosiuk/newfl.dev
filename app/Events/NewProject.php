<?php

namespace App\Events;

use App\Contracts\ProjectsContract;
use App\Models\Projects;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewProject implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Projects
     */
    protected $project;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
//    protected $freelancers;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($project, $user)
    {
        $this->project = $project;
        $this->user = $user;
//        $this->freelancers = $freelancers;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['project'];
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'project' => $this->project,
            'user' => $this->user
        ];
    }

    /**
     * @return ProjectsContract
     */
//    public function model()
//    {
//        return $this->model;
//    }

    /**
     * @return Projects
     */
    public function project()
    {
        return $this->project;
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return array
     */
//    public function freelancers()
//    {
////        if ($this->user()->hasRole('Freelancer')) {
//            return $this->user->name;
////        }
//    }
}
