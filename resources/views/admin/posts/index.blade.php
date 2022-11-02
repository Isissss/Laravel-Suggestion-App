@extends('layouts.web')

@section('content')
    <h1>Posts in development</h1>
    <table class="table table-sm align-text-bottom w-75" id="categories">
        <thead>
        <tr>
            <th scope="col">Posts <span class="badge rounded-pill bg-info">{{$posts->count()}}</span></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td><a class="btn btn-sm bg-light" href="{{route('posts.show', $post)}}">View</a></td>
            </tr>
        @endforeach()
        </tbody>
    </table>
@endsection


