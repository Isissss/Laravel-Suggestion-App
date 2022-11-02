@extends('layouts.web')

@section('content')
    <div class="col-flex  justify-content-center mx-auto" style="width:50%">
        @if($user == auth()->user())
        <div class="card">
            <div class="card-header">
                Profile
            </div>
            <div class="card-body">

                <div class="d-flex col">
                    <div>
                        <a href="{{route('users.edit', $user)}}" class="btn btn-success">Edit</a>
                    </div>
                    <div class="mx-3">
                        <form method="POST" action="{{route('users.destroy', $user)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This cannot be undone!')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="card mt-4">
            <div class="card-header">
                Suggestions of {{$user->name}} ({{$user->posts()->active()->count()}})
            </div>
            <div class="card-body">
                @foreach($user->posts()->active()->get() as $post)
                    <div class="border p-2 m-2"><a href="{{route('posts.show', $post)}}">{{$post->title}}</a>
                        @if($post->category)
                        <span class="badge badge-primary fs-6"
                              style="border-color:unset;background-color:{{$post->category->color}}"> {{$post->category->name}}</span>
                        @endif
                        @if ($post->status)
                        <x-post-status-label :post="$post"></x-post-status-label>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

@endsection
