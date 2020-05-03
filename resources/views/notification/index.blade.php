@foreach ($notis as $noti)
    @if ($noti->is_read == 0)
        <a class="text-decoration-none text-dark" href="{{route('posts.show',$noti->id_target)}}"><div class="bg-info" style="border-bottom: 1px solid black; padding: 15px 5px;cursor: pointer;">
            @if ($noti->type == "post that you're following")
                <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} on the {{$noti->type}}</div>
            @else
                <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} in your {{$noti->type}}</div>
            @endif
        </div></a>
    @else
        <a class="text-decoration-none text-dark" href="{{route('posts.show',$noti->id_target)}}"><div style="border-bottom: 1px solid black; padding: 15px 5px;cursor: pointer;">
            @if ($noti->type == "post that you're following")
                <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} on the {{$noti->type}}</div>
            @else
                <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} in your {{$noti->type}}</div>
            @endif
        </div></a>
    @endif
@endforeach
