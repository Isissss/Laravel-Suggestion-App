<?php

namespace App\Listeners;

use App\Events\PostInDevelopment;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrelloDevelopmentPost implements ShouldQueue
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
    public $delay = 3;


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(PostInDevelopment $event)
    {
        $post = $event->post;

        $response = Http::post('https://api.trello.com/1/cards?', [
            'key' => config('services.trello.key'),
            'token' =>  config('services.trello.token'),
            'name' => $post->title,
            'desc' => "$post->description \n\n┆ Suggested by {$post->user->name}. Synced from [here](http://127.0.0.1:8000/posts/$post->id)",
            'idList' => config('services.trello.idList')
        ]);

        $post->trello_id = $response->json('shortLink');
        Post::withoutTimestamps(fn () => $post->update());

    }
}
