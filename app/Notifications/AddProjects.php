<?php

namespace App\Notifications;

use App\Contracts\ProjectsContract;
use App\Models\Projects;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddProjects extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    protected $project;

    /**
     * @var array
     */
    protected $author;


    /**
     * Create a new notification instance.
     *
     * @param $project
     */
    public function __construct($project, $author)
    {
        $this->project = $project;
        $this->author = $author;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', 'https://laravel.com')
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'icon' => 'list',
            'color_icon' => 'green-text',
            'project' => $this->project,
            'author' => $this->author,
        ];
    }

}
