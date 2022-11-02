<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandlePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        // Check for posts with an active category
        $posts = Post::active()
            ->filter(request(['search', 'category', 'tags']))
            ->sort(request('sort'))
            ->withCount('comments', 'likes')
            ->paginate(8)
            ->withQueryString();

        $webtitle = 'Suggestions';
        $tags = Tag::all();
        $categories = Category::active()->get();

        return view('posts.index', compact('posts', 'tags', 'webtitle', 'categories'));
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->latest()->paginate(5),
            'webtitle' => 'Suggestions',
            'hasLiked' => auth()->user()?->hasLiked($post),
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            'webtitle' => 'Suggestions',
            'tags' => Tag::all(),
            'categories' => Category::latest()->active()->get()
        ]);
    }

    public function store(HandlePostRequest $request)
    {
        $post = Post::create(array_merge($request->validated(), [
            'user_id' => $request->user()->id,
            'attachment' => $request->file('attachment')?->store('attachments')
        ]));

        $post->tags()->attach($request['tag_id']);

        return redirect(route('posts.show', $post));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::latest()->active()->get()
        ]);
    }

    public function update(Post $post, HandlePostRequest $request)
    {
        $validated = $request->validated();

        if ($request->attachment !== null) {
            if ($post->attachment && Storage::exists($post->attachment)) {
                Storage::delete($post->attachment);
            }
            $validated['attachment'] = request()->file('attachment')->store('attachments');
        }

        $post->tags()->sync($request['tag_id']);

        $post->update($validated);

        return redirect(route('posts.show', $post));
    }

    public function destroy(Post $post)
    {
        if ($post->attachment && Storage::exists($post->attachment)) {
            Storage::delete($post->attachment);
        }

        $post->delete();

        return redirect(route('posts.index'))->with('message', 'Post has been deleted');
    }
}


