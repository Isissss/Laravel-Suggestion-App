<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Post $post)
    {
       if(gate::denies('create-comment', $post)) {
           return redirect(route('posts.show', $post))->with('message', 'This post has been closed');
       }

        $attributes = request()->validate([
            'message' => 'required|string|max:500'
        ]);

        $attributes['user_id'] = auth()->id();

        $post->comments()->create($attributes);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
