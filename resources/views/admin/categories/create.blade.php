@extends('layouts.web')


@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="w-75">
                <div class="card">
                    <div class="card-header">New Category</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('categories.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Server/Location</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}" required>

                                    @error('name')
                                    <div class="alert  alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="color" class="col-md-4 col-form-label text-md-end">Prefix color</label>
                                <div class="col-md-6">
                                    <input id="color"
                                           type="color"
                                           class="form-control @error('color') is-invalid @enderror"
                                           name="color"
                                           value="{{ old('color') }}" required>
                                    @error('color')
                                    <div class="alert  alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="active" class="col-md-4 col-form-label text-md-end">Active</label>
                                <div class="col-md-6">
                                    <input type="radio" id="active" name="active" value="1" checked>
                                    <label for="active">Yes</label><br>
                                    <input type="radio" id="inactive" name="active" value="0">
                                    <label for="inactive">No</label><br>
                                    @error('active')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





