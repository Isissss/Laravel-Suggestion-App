@extends('layouts.web')

@section('content')
    <h1>Users</h1>
    <table class="table table-sm align-text-bottom" id="categories">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{route('users.show', $user)}}">{{$user->name}}</a> @if($user->admin)<span
                        class="badge text-bg-danger ">Admin</span>@endif</td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('users.edit', $user)}}">Edit</a></td>
                <td>
                    <form method="POST" class="m-0 p-0" action="{{route('users.destroy', $user)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link m-0 p-0"
                                onclick="return confirm('Are you sure? This will not remove posts associated with this user.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach()
        </tbody>
    </table>
@endsection


