@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row" style="padding: 2% 10% 0">
        <div class="col-7" style="height: ">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="">
        </div>
        <div class="col-5">
            <div class="header d-flex justify-content-between align-items-center">
                <a class="text-decoration-none text-dark" href="{{route('profile.show',$user->id)}}"><strong>{{$user->username}}</strong></a>
                @if ($user->id != auth()->user()->id)
                <follow-button user-id=" {{ $user->id }} " follows=" {{ $follows}} "></follow-button>
                @endif
                @if ($user->profile->url_thumb != '')
                <a href="{{route('profile.show',$user->id)}}"><img witdh="30px" height="30px" src="/thumbs/{{$user->profile->url_thumb}}" style="border-radius: 50%;" alt=""></a> 
                @else
                <a href="{{route('profile.show',$user->id)}}"><img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt=""></a>
                @endif
            </div>
            <hr>
            <a class="text-decoration-none text-dark" href="{{route('profile.show',$user->id)}}"><strong>{{$user->username}} </strong> </a>{{ $post->caption }}
            <div style="font-size:12px">{{$post->getTime()}}</div>
            <div id="comments" class="overflow-auto" style="height: 500px">
            @foreach ($comments as $comment)
                <div class="d-flex" style="position: relative">
                    @if ($comment->user->profile->url_thumb != '')
                        <a href="{{route('profile.show',$comment->user->id)}}"><img witdh="30px" height="30px" src="/thumbs/{{$comment->user->profile->url_thumb}}" alt="" style="border-radius: 50%;"></a> 
                    @else 
                        <a href="{{route('profile.show',$comment->user->id)}}"><img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt=""></a>
                    @endif
                    <div>
                        <div class="d-flex bd-highlight mb-2">
                            <div class="flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="{{route('profile.show',$comment->user->id)}}"><strong>{{$comment->user->username}}</strong></a> {{$comment->content}}</div>
                            @if ($comment->is_liked())
                                <button style="position: absolute;top: 0%;right: 2%;" data-id="{{$comment->id}}" class="btn btn-primary like-comment-post">UnLike</button>
                            @else 
                                <button style="position: absolute;top: 0%;right: 2%;" data-id="{{$comment->id}}" class="btn btn-primary like-comment-post">Like</button>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div style="font-size:12px">{{$comment->getTime()}}</div>
                            <div class="reply" id="reply{{$comment->id}}" >&nbsp&nbspReply</div>
                            <div class="ml-2"><strong id="count_like_cmt{{$comment->id}}">{{$comment->likedCmt->count()}}</strong> Likes</div>
                        </div>
                        <div id="replys{{$comment->id}}">
                            @foreach ($comment->replyComment as $replyCmt)
                                <div class="d-flex">
                                    @if ($replyCmt->user->profile->url_thumb != '')
                                        <a href="{{route('profile.show',$replyCmt->user->id)}}"><img witdh="30px" height="30px" src="/thumbs/{{$replyCmt->user->profile->url_thumb}}" alt="" style="border-radius: 50%;"></a> 
                                    @else 
                                        <a href="{{route('profile.show',$replyCmt->user->id)}}"><img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt=""></a>
                                    @endif
                                    <div class="ml-3"><a class="text-decoration-none text-dark" href="{{route('profile.show',$replyCmt->user->id)}}"><strong>{{$replyCmt->user->username}}</strong></a> {{$replyCmt->content}}</div>
                                </div>
                            @endforeach
                        </div>
                        <form class="d-none form-reply-comment" data-id="{{$comment->id}}" id="replyComment{{$comment->id}}" action="{{route('posts.reply',$comment->id)}}" method="post">
                            @csrf
                            <input class="form-control replyInput" type="text" id="replyCmt" name="replyCmt" placeholder="Write a reply..." style="height: 30px" required>
                            <input type="hidden" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>
                        </form>
                    </div>
                    
                </div>
            @endforeach
            </div>
            <div>
                <div class="d-flex flex-column">
                    @if ($post->is_liked())
                        <button id="like" data-id="{{$post->id}}" class="btn btn-primary">UnLike</button>
                    @else
                        <button id="like" data-id="{{$post->id}}" class="btn btn-primary">Like</button>
                    @endif
                    <div><strong id="count_like{{$post->id}}">{{$post->liked->count()}}</strong>Likes</div>
                </div>
                <form class="form-comment-post"  action=" {{route('posts.comment',$post->id)}} " method="post">
                    @csrf
                    <div class="d-flex" style="position: relative">
                        <input class="form-control commentInput" type="text" id="comment" name="comment" placeholder="Add a comment..." style="height: 50px" required>
                        <input type="submit" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>
                        <div id="request_data"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row pt-2">
        <p style="color:teal">More post from <a class="text-decoration-none text-dark" href="{{route('profile.show',$user->id)}}"><span><strong>{{ $user->username}}</strong></span></p>
    </div>
    <div class="row mt-2">
        @foreach ($posts as $post)
            <div class="col-4" style="padding: 15px">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="" height="400">
            </div>
        @endforeach
    </div>
</div>   
@endsection