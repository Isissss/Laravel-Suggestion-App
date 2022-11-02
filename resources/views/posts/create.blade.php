@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">New Post</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                                <div class="col-md-6">
                                    <input id="title"
                                           type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           value="{{ old('title') }}" required>

                                    @error('title')
                                    <div class="alert  alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category_id"
                                       class="col-md-4 col-form-label text-md-end">Server/Location</label>
                                <div class="col-md-6">
                                    <select required
                                            name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            id="category_id">
                                        <option value="" selected hidden>Select a server</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if (old('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="alert  alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Why are you
                                    suggesting this?</label>
                                <div class="col-md-6">
                                    <textarea class="form-control"
                                              name="description"
                                              id="description"
                                              rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="alert  alert-danger">{{  $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tag_id" class="col-md-4 col-form-label text-md-end">Tags (optional)</label>
                                <div class="col-md-6">
                                    @foreach($tags as $tag)
                                        <label for="{{$tag->id}}" class="ms-2">{{$tag->name}}</label>
                                        <input type="checkbox" id="{{$tag->id}}" value="{{$tag->id}}" @if(old('tag_id')) @if(in_array($tag->id, old('tag_id'))) checked @endif @endif name="tag_id[]">
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            @error('tag_id')
                            <div class="alert  alert-danger">{{  $message }}</div>
                            @enderror
                            <div class="row mb-3">
                                <label for="attachment" class="col-md-4 col-form-label text-md-end">Attachments
                                    (optional)</label>
                                <div class="col-md-6">
                                    <input id="attachment"
                                           type="file"
                                           class="form-control @error('attachment') is-invalid @enderror"
                                           name="attachment">
                                    @error('attachment')
                                    <div class="alert  alert-danger">{{ $message }}</div>
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




