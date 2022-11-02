<?php

namespace App\Listeners;

use App\Mail\StatusChangeMail;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusChangeMail implements shouldQueue
{
    public Post $post;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 1;


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $post = $event->post;
        Mail::to($post->user->email)->send(new StatusChangeMail($post));
    }
}
