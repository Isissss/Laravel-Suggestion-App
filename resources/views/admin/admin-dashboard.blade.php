@extends('layouts.web')
@vite(['resources/js/admin.js'])

@section('content')
    @if(Session::has('message'))
        <p class="alert alert-info"> {{ Session::get('message') }} </p>
    @endif
         <h1>Admin panel</h1>
    <a href="{{url('admin/categories/create')}}">Create</a>
            <table class="table " id="categories">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Active</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td> {{$category->name}} <span class="badge rounded-pill bg-info">{{$category->posts_count}}</span></td>
                        <td><span class="badge" style="background:{{$category->color}}">{{$category->color}}</span></td>
                        <td>
                            <div class="form-check form-switch"><input type="checkbox" role="switch" id="flexSwitchCheckDefault" class="active-btn form-check-input" data-id="{{($category->id)}}"
                                   @if($category->active) checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </td>
                        <td><a href="{{route('categories.edit', $category)}}">Edit</a></td>
                        <td>
                            <form method="POST" class="m-0 p-0" action="{{route('categories.destroy', $category)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-0 p-sm-0" onclick="return confirm('Are you sure? This will remove ALL {{$category->posts_count}} posts associated with this category.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach()
                </tbody>
            </table>

 @endsection





