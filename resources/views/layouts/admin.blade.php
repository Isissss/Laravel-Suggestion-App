<div class="container-lg">
    <div class="d-flex justify-content-center">
        <div class="pe-3" style="border-right:1px lightgray solid"><h2>Admin panel</h2>
            <p>
                <a class="d-block text-muted @if(Request::is('admin/posts')) text-decoration-underline @else text-decoration-none @endif"
                   href="{{url('admin/posts')}}">Manage Posts in Development</a>
                <a class="d-block text-muted @if(Request::is('admin/categories')) text-decoration-underline @else text-decoration-none @endif"
                   href="{{url('admin/categories')}}">Manage Categories</a>
                <a class="d-block text-muted @if(Request::is('admin/users')) text-decoration-underline @else text-decoration-none @endif"
                   href="{{route('users.index')}}">Manage Users</a>
            </p>
        </div>
        <div class="px-3 flex-grow-1">
            @yield('content')
        </div>
    </div>
</div>
