<div class="card mt-3">
    <div class="card-body " id="commentbody">

        <div class="div1 text-center" style="align-content: center; margin-right:12px;">
            <x-profile style="height:40px; align-content: center" :picture="$comment->user->mc_uuid"/>
          @if($comment->user->admin)<span class="badge rounded-pill text-bg-danger mt-2 left-0" style="margin-left:0;">ADMIN</span>@endif
        </div>

        <div class="div2">
            Posted by {{$comment->user->name}} <br>
            <small class="text-muted">{{$comment->created_at->format('F j Y, g:i a')}} </small>
        </div>

        <div class="div3 py-2">
            {{$comment->message}}
        @can('delete', $comment)
            <form method="POST" action="{{route('comment.destroy', $comment)}}" class="position-absolute end-0 top-0 mt-3 me-3">
                @csrf
                @method('DELETE')
                <button class="btn btn-link ">Delete</button>
            </form>
        @endcan
    </div>
    </div>
</div>

