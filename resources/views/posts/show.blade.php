@extends('layouts.web')
@vite(['resources/js/likehandler.js'])

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif

                        <h3 class="card-title"><strong>{{$post->title}} </strong></h3>
                        <span class="badge fw-normal fs-6 badge-primary"
                              style="border-color:unset;background-color:{{$post->category?->color}}"> {{$post->category?->name}}</span>
                        @if($post->status)
                            <x-post-status-label :post="$post"></x-post-status-label>
                        @endif

                        @if($post->tags->count() > 0)
                            <div class="my-1"><i class="fas fa-tag"></i>
                                @foreach($post->tags as $tag)
                                    <span class="badge pill bg-secondary fw-normal">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        @endif
                        <p class="card-text">{{$post->description}}</p>
                        <p>
                        <h4>Upvoted <span class="fw-bold" id="upvoted-count">{{$post->likes()->count()}}</span> times
                        </h4>
                        </p>
                        @if($post->attachment !== null)
                            <div class="mt-2 d-flex row">
                                <span>Attachments:</span>
                                <img src="{{ asset("storage/$post->attachment") }}"
                                     style="max-height:250px; width: fit-content">
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <div class="pt-2">
                                <x-profile style="height:30px; margin-right:4px" :picture="$post->user?->mc_uuid"/>
                                Suggested by <a
                                    href="{{route('users.show', $post->user)}}">{{$post->user->name ?? "Deleted user"}}</a>
                                on
                                <time>{{$post->created_at->format('F j Y')}} </time> @unless ($post->created_at->eq($post->updated_at))
                                    <small class="text-muted"> &middot; edited</small>
                                @endunless
                                <br>
                                @auth()
                                    @can(['like'], $post)
                                        <button class="btn w-50 mt-2 @if($hasLiked)voted @endif" data-id="{{$post->id}}"
                                                id="like-btn">@if($hasLiked) Voted <i
                                                class="fas fa-thumbs-up"></i> @else Upvote
                                            <i class="far fa-thumbs-up"></i> @endif</button>
                                    @endcan
                                @endauth

                            </div>


                            <div class="p-2">
                                @canany(['update', 'delete'], $post)
                                    <a class="btn btn-link text-muted p-0 m-0" href="{{route('posts.edit', $post)}}">Edit</a>
                                    <form method="POST" style="display: inline" {{route('posts.destroy', $post)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-muted" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                    </form>
                                @endcanany
                                @admin
                                <button type="button" class="btn btn-link text-muted p-0 m-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    Change status
                                </button>
                                @endadmin
                            </div>
                        </div>
                    </div>
                </div>
                <label for="message" class="fs-4 fw-bold mt-3">Comments</label> <br>

                @guest()
                    <a href="{{route('login')}}" class="btn btn-sm btn-outline-primary ">Log in to leave a comment</a>
                @endguest

                @auth()
                    @can('create-comment', $post)
                        <form method="POST" class="m-0" action="{{route('comment.store', $post)}}">
                            @csrf
                            <div class="form-group">
                              <textarea required class="form-control bg-white" name="message" id="message"
                                        placeholder="Write something!"
                                        rows="3"></textarea>
                            </div>
                            @error('message')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <button class="btn btn-outline-primary mt-2 position-relative top-0" type="submit">Post
                                comment
                            </button>
                        </form>

                    @else
                        This post no longer accepts responses
                    @endcan

                @endauth

                <div class="my-lg-3 ">
                    @foreach($comments as $comment)
                        @include('partials.comment')
                    @endforeach()
                </div>

                <div class="mt-4">
                    {{ $comments->links()}}
                </div>

                @admin
                <x-modal>
                    <x-slot:title>
                        Change Status
                    </x-slot:title>
                    <form method="POST" action="{{route('admin.posts.update', $post)}}">
                        @csrf
                        @method('PATCH')
                        @foreach(\App\Models\Status::all() as $status)
                            <label for="{{$status->name}}">{{$status->name}}</label>
                            <input id="{{$status->name}}"
                                   name="status_id"
                                   value="{{$status->id}}"
                                   type="radio"
                                   @if($status == $post->status)
                                   checked
                                   @endif
                                   class="@error('name') is-invalid @enderror ">
                            <br>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </x-modal>
                @endadmin
            </div>
        </div>
    </div>
@endsection



