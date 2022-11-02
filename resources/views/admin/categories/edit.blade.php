@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="w-75">
                <div class="card">
                    <div class="card-header">New Category</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('categories.update', $category)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Category Title</label>
                                <div class="col-md-6">
                                    <input id="name"
                                           name="name"
                                           value="{{$category->name}}"
                                           type="text"
                                           class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }} </div> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="color" class="col-md-4 col-form-label text-md-end">Color</label>
                                <div class="col-md-6">
                                    <input id="color"
                                           name="color"
                                           value="{{$category->color}}"
                                           type="color"
                                           class="form-control @error('color') is-invalid @enderror">

                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

