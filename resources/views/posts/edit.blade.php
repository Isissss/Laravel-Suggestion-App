@extends('layouts.web')


@section('content')
    <div class="col-flex  justify-content-center mx-auto mb-0" style="width:50%">
        <div class="card ">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('posts.update', $post)}}">
                    @csrf
                    @method('PATCH')
                    <label class="mt-2" for="title">Post Title</label>
                    <input id="title"
                           name="title"
                           value="{{old('title') ?? $post->title}}"
                           type="text"
                           class="@error('title') is-invalid @enderror form-control">

                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label class="mt-2" for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}"{{old('category_id') ?? ($post->category->is($category) ? "selected" : '') }}>{{$category?->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="description" class="mt-2">Example textarea</label>
                        <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            rows="3">{{old('description') ? old('description') : $post->description}}</textarea>
                    </div>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="tag_id" class="mt-2">Tags (optional)</label><br>
                            @foreach($tags as $tag)
                                <label for="{{$tag->id}}" class="ms-2">{{$tag->name}}</label>
                                <input type="checkbox" id="{{$tag->id}}" value="{{$tag->id}}" @if(old('tag_id')) @if(in_array($tag->id, old('tag_id'))) checked @endif  @elseif($post->tags->contains($tag->id)) checked @endif name="tag_id[]">
                                <br>
                            @endforeach
                        </div>
                    @error('tag_id')
                    <div class="alert  alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="attachment" class="mt-2">Attachments (optional)</label>
                    <div class="col-md-6">
                        <input id="attachment"
                               type="file"
                               class="form-control @error('attachment') is-invalid @enderror"
                               name="attachment">

                        @error('attachment')
                        <div class="alert  alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
@endsection


