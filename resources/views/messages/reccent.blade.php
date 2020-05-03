<ul class="users">
@if (isset($user))
@foreach($users as $user)
<li class="user" id="{{ $user->id }}">
    {{--will show unread count notification--}}
    @if($user->unread)
        <span id="pen{{$user->id}}" class="pending">{{ $user->unread }}</span>
    @endif
    {{-- <span class="pending">1</span> --}}

    <div class="media">
        @if ($user->url_thumb != '')
            <div class="media-left">
                <img src="/thumbs/{{ $user->url_thumb}}" alt="" class="media-object">
            </div>
        @else
            <div class="media-left">
                <img src="/thumbs/default_ava.jpg" alt="" class="media-object">
            </div>
        @endif
        <div class="media-body">
            <p class="name">{{ $user->name }}</p>
            <p class="email">{{ $user->email }}</p>
        </div>
    </div>
</li>
@endforeach
@endif
</ul>
@if (isset($user) == false)
    <h4 style="position: absolute;top: 20%;left:10%;">You don't have reccent message!</h4>
@endif