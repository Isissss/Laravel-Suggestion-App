@extends('layouts.web')
@section('content')

    <div class="col-flex  justify-content-center mx-auto" style="width:50%">
        <div class="card">
            <div class="card-header">
                Edit profile
            </div>
            <div class="card-body">
                <form method="POST" action="{{$formRoute}}">
                    @csrf
                    @method('PATCH')
                    <label for="name">{{ __('Minecraft Username') }}</label>

                    <input id="name"
                           name="name"
                           value="{{old('name') ?? $user->name}}"
                           type="text"
                           class="@error('name') is-invalid @enderror form-control">

                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <label class="mt-2" for="email">{{ __('Email Address') }}</label>

                    <input id="email"
                           name="email"
                           value="{{old('email') ?? $user->email}}"
                           type="email"
                           class="@error('email') is-invalid @enderror form-control">

                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @can('give-admin')
                        @if($user->id !== auth()->id())
                            <label class="mt-2" for="email">Admin</label>
                            <input id="admin"
                                   value=true
                                   name="admin"
                                   @if($user->admin) checked @endif
                                   type="checkbox"
                                   class="@error('admin') is-invalid @enderror">

                            @error('admin')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <br>
                            <label class="mt-2" for="password">{{ __('Password') }}</label>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   placeholder="Password is required when giving an user admin"
                                   class="@error('password') is-invalid @enderror form-control">

                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @endif
                    @endcan
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
