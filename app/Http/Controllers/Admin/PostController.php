<?php

namespace App\Http\Controllers\Admin;

use App\Events\PostInDevelopment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', ['posts' => Post::where('status_id', '=', 2)->withcount('likes')->get()]);
    }

    public function changeStatus(Post $post, Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required|integer|exists:statuses,id'
        ]);

        Post::withoutTimestamps(fn () => $post->update($validated));

        if($validated['status_id'] == 2 && !$post->trello_id) {
            // Send mail and create Trello card
            PostInDevelopment::dispatch($post);
        }

        return redirect(route('posts.show', $post))->with('message', 'Post has been updated');
    }
}
