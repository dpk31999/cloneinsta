@extends('layouts.app')
@section('content')
    <div class="container" style="padding: 0 20%">
        <h3>Notification</h3>
        <div>
            @foreach ($notis as $noti)
                <a class="text-decoration-none text-dark" href="{{route('posts.show',$noti->id_target)}}">
                    <div style="border-bottom: 1px solid black; padding: 15px 5px;cursor: pointer;">
                        @if ($noti->type == "post that you're following")
                            <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} on the {{$noti->type}}</div>
                        @else
                            <div><strong>{{$noti->user->username}}</strong> {{$noti->action}} in your {{$noti->type}}</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection