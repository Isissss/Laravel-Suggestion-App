<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LikeController extends Controller
{
    public function likeHandler(Post $post)
    {
        $this->authorize('like', [$post, auth()->user()]);

        $like = auth()->user()->hasLiked($post);

        if (!$like) {
            $this->store($post);
        }
        else {
            $this->destroy($like);
        }
    }

    public function store(Post $post)
    {
        $post->likes()->create(['user_id' => auth()->id()]);
    }

    public function destroy(Like $like)
    {
        $like->delete();
    }
}
