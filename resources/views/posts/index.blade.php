@extends('layouts.web')
@section('title', $webtitle)

@section('content')
    <div class="bg-light">
        <div class="container">
            @auth
                @can('create', App\Models\Post::class)
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-primary active mb-3">New suggestion</a>
                @else
                    <p> You must have liked or reacted to 3 suggestions before you can post.</p>
                @endcan
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary mb-3">Register to add a suggestion!</a>
            @endguest
            <div class="px-0 mb-3 d-flex justify-content-between">
                <div>
                    <form method="GET" action="{{route('posts.index')}}" id="category-filter">
                        <div class="btn-group me-3" role="group">
                            <input class="btn-check" name="sort" id="sort-top" type="radio" value="top"
                                   @if(request('sort') === "top" || !request('sort')) checked @endif />
                            <label class="btn btn-outline-secondary @checked("active")" for="sort-top"><i
                                    class="far fa-star"></i> Top</label>

                            <input class="btn-check" name="sort" id="sort-new" type="radio" value="new"
                                   @if(request('sort') === "new") checked @endif />
                            <label class="btn btn-outline-secondary @checked("active")" for="sort-new"><i
                                    class="far fa-clock"></i> Newest</label>
                        </div>
                        <a class="btn btn-outline-primary @if(!request('category')) active @endIf "
                           href="{{ route('posts.index', http_build_query(request()->only('sort')) )}} ">All</a>
                        @foreach($categories as $category)
                            <input class="btn-check tag-input" name="category[]" type="checkbox" id="{{$category->id}}"
                                   value="{{$category->name}}"
                                   @if(request('category') && in_array($category->name, request('category'))) checked @endif />
                            <label class="btn btn-outline-primary" for="{{$category->id}}">{{$category->name}}</label>
                    @endforeach
                </div>
                <div class="d-flex">
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                id="openFilter" aria-expanded="false">
                            <i class="fas fa-filter"></i> Filter Tags
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($tags as $tag)
                                <label for="tag-{{$tag->id}}" class="ms-2">{{$tag->name}}</label>
                                <input type="checkbox" id="tag-{{$tag->id}}" name="tags[]"
                                       @if(request('tags') && in_array($tag->name, request('tags'))) checked
                                       @endif value="{{$tag->name}}"><br>
                            @endforeach
                            <button type="submit" class="btn btn-primary ms-2">Apply</button>
                        </ul>
                    </div>
                    <input type="text" name="search" class="form-control ms-2"
                           @if(request('search')) value="{{  request('search') }}"
                           @else placeholder="Search..." @endif aria-label="Search">
                </div>
                </form>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="75" role="img"
                                 focusable="false">
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em" text-anchor="middle"
                                      font-weight="bolder">
                                    {{$post->likes_count}} Votes
                                </text>
                            </svg>
                            <div class="card-body">
                                @if($post->category_id)
                                    <span class="badge pill fw-normal fs-6"
                                          style="border-color:unset;background-color:{{$post->category->color}}">{{$post->category->name}}</span>
                                @endif
                                @if($post->status)
                                    <x-post-status-label :post="$post"></x-post-status-label>
                                @endif
                                <p class="card-text pt-2" style="height:100px; overflow:hidden">
                                    <a href="{{route('posts.show', $post)}}">
                                        <strong>{{(strlen($post->title) > 25 ? substr($post->title, 0, 35) . ".." : $post->title)}}</strong>
                                    </a>
                                    <br>
                                    {{substr($post->description, 0, 75) . '..'}}<br>
                                <p class="pb-0 mb-0">Posted by {{$post->user->name ?? "Deleted user"}} </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <time class="text-muted">{{$post->created_at?->format('F j Y')}} </time>
                                    <span> <i class="fas fa-comments"></i> {{$post->comments_count}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $posts->links()}}
            </div>
        </div>
    </div>
@endsection
