@extends('layouts.app')

@section('content')
<div class="container" style="padding: 0 9%">
    <div class="row pl-5">
        <div class="col-3 p-2">
            <form id="uploadform" action=" {{ route('profile.image') }} " method="post" enctype="multipart/form-data">
                @csrf
                <div class="image-upload">
                    <label for="file-input">
                        <?php
                        if($user->profile->url_thumb != ''){
                            echo '<img class="w-100" src="/thumbs/' . $user->profile->url_thumb  .'" style="border-radius: 50%;" alt="">';
                        }
                        else{
                            echo '<img class="w-75" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt="">';
                        }
                        ?>
                    </label>
                    <?php 
                        if(auth()->user()->id == $user->profile->user_id){
                            echo '<input id="file-input" type="file" name="image" id="image" onchange="this.form.submit()" />';
                        }
                    ?>
                    @error('image')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between alight-items-baseline">
                <p style="font-size:2vw;">{{ $user->username }}</p>
                    @if ($user->id == auth()->user()->id)
                        <a href="{{ route('profile.edit') }}"><button class="btn btn-light border font-weight-bold">Edit Profile</button></a>
                        <i style="cursor: pointer" class="fas fa-cog fa-2x" data-toggle="modal" data-target="#exampleModal"></i>
                    @else
                        <?php
                            if($follows == 1){
                                $follows = true;
                            }
                            else{
                                $follows = false;
                            }
                        ?>
                        <follow-button user-id=" {{ $user->id }} " follows=" {{ $follows}} "></follow-button>
                    @endif
                @if($user->id == auth()->user()->id)
                <a href="/p/create">Add New Post</a>
                @endif
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong> {{ $user->following->count()}} </strong> followers</div>
                <div class="pr-5"><strong> {{$user->profile->followers->count()}} </strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach ($user->posts as $post1)
            <div class="col-4 pb-4">
                <a href=" {{ route('posts.show', $post1->id)}} "><img id="myImg" class="w-100" src="/storage/{{ $post1->image }}" alt=""></a>
            </div>
        @endforeach   
    </div>
</div>
@if( isset($check_show) )
<div id="myModal" class="modal" style="padding: 40px 200px; background-color: rgba(0,0,0,0.5);
    <?php
        if(isset($check_show)){
            echo 'display: block;';
        }
    ?>
">
    <div class="modal-content">
        <div class="modal-body" style="padding: 40px 0px;">
            <div class="container">
                <div class="row">
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
                        <strong>{{$user->username}}</strong> {{ $post->caption }}
                        <div style="font-size:12px">{{$post->getTime()}}</div>
                        <div id="comments" class="overflow-auto mt-2" style="height: 300px">
                            @foreach ($comments as $comment)
                                <div class="d-flex">
                                    @if ($comment->user->profile->url_thumb != '')
                                        <a href="{{route('profile.show',$comment->user->id)}}"><img witdh="30px" height="30px" src="/thumbs/{{$comment->user->profile->url_thumb}}" alt="" style="border-radius: 50%;"></a>
                                    @else 
                                        <a href="{{route('profile.show',$comment->user->id)}}"><img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt=""></a>
                                    @endif
                                    <div>
                                        <div class="d-flex bd-highlight">
                                            <div class="flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="{{route('profile.show',$comment->user->id)}}"><strong>{{$comment->user->username}}</strong></a> {{$comment->content}}</div>
                                            <div style="float: right;">
                                                @if ($comment->is_liked())
                                                    <button id="likeCmt{{$comment->id}}" class="btn btn-primary like-comment">UnLike</button>
                                                @else 
                                                    <button id="likeCmt{{$comment->id}}" class="btn btn-primary like-comment">Like</button>
                                                @endif
                                            </div>
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
                                    <button id="like{{$post->id}}" class="btn btn-primary like-post">UnLike</button>
                                @else
                                    <button id="like{{$post->id}}" class="btn btn-primary like-post">Like</button>
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
            </div>
        </div>
    </div>
  
</div>
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content content">
        <a class="text-decoration-none text-dark" href="{{route('profile.editpass')}}"><div class="in-setting">Change Password</div></a>
        <a class="text-decoration-none text-dark" href="{{route('notification')}}"><div class="in-setting">Notification</div></a>
        <div class="in-setting" style="cursor: pointer" data-dismiss="modal" data-toggle="modal" data-target="#ModalReport">Report a Problem</div>
        <a class="text-decoration-none text-dark" href="{{route('logout')}}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <div class="in-setting">Log Out</div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="in-setting" data-dismiss="modal" aria-label="Close" style="cursor: pointer">Cancel</div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content content">
        <div class="modal-header" style="position: relative">
            <h5 class="modal-title" style="position: absolute; left: 35%;font-size: 15px;font-weight: bold" id="exampleModalLabel">Report a Problem</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size: 20px" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form_report" action="{{route('report.create')}}"method="POST">
                <div class="form-group">
                    <textarea placeholder="Briefly explain what happened." class="form-control" id="content_report" rows="5" required></textarea>
                    <button type="submit" id="btn_send_report" class="btn btn-primary mt-2">Send Report</button>
                </div>
            </form>
            <p style="color: #4c4848; font-weight: 400; font-size: 12px; line-height: 14px; margin: -2px 0 -3px;">Your Instagram username and browser information will be automatically included in your report.</p>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalThank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content content">
        <div class="modal-header" style="position: relative">
            <h5 class="modal-title" style="position: absolute; left: 35%;font-size: 15px;font-weight: bold" id="exampleModalLabel">Report a Problem</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size: 20px" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div>Thank you for reporting this problem.</div>
            <button class="btn btn-primary mt-2" style="font-size: 13px;font-weight: 900; width: 100%" data-dismiss="modal">Done</button>
        </div>
        </div>
    </div>
</div>
@endsection
