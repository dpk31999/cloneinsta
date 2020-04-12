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
        @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
                <a href=" {{ route('posts.show', $post->id)}} "><img id="myImg" class="w-100" src="/storage/{{ $post->image }}" alt=""></a>
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
                        <img class="w-100" src="/storage/{{ $image }}" alt="">
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
                        <strong>{{$user->username}}</strong> {{ $caption }}
                        <div style="font-size:12px">{{$get}}</div>
                        <div id="comments" class="overflow-auto mt-2" style="height: 300px">
                            @foreach ($comments as $comment)
                                <div class="d-flex">
                                    @if ($comment->user->profile->url_thumb != '')
                                        <a href="{{route('profile.show',$comment->user->id)}}"><img witdh="30px" height="30px" src="/thumbs/{{$comment->user->profile->url_thumb}}" alt="" style="border-radius: 50%;"></a>
                                    @else 
                                        <a href="{{route('profile.show',$comment->user->id)}}"><img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt=""></a>
                                    @endif
                                    <div>
                                        <?php
                                        $likeCm = DB::table('comment_user')->where([
                                            ['user_id', auth()->user()->id],
                                            ['comment_id', $comment->id],
                                        ])->get();
        
                                        $likesCm = false;
                                        if($likeCm->count() > 0){
                                            $likesCm = true;
                                        }
                                        ?>
                                        <div class="d-flex bd-highlight">
                                            <div class="flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="{{route('profile.show',$comment->user->id)}}"><strong>{{$comment->user->username}}</strong></a> {{$comment->content}}</div>
                                            <div style="float: right;"><like-comment user-id=" {{ $comment->user->id }} " comment-id=" {{ $comment->id }} " likes=" {{ $likesCm }} " countlike=" {{ $comment->likedCmt->count() }} "></like-comment></div>
                                        </div>
                                        <div class="d-flex">
                                            <div style="font-size:12px">{{$comment->getTime()}}</div>
                                            <div class="reply" id="reply{{$comment->id}}" >&nbsp&nbspReply</div>
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
                            <?php 
                            $like = DB::table('post_user')->where([
                                ['user_id', auth()->user()->id],
                                ['post_id', $id_post],
                            ])->get();
                            $likes = false;
                            if($like->count() > 0){
                                $likes = true;
                            }
                            
                            ?>
                            <like-button user-id=" {{ $id_user }} " post-id=" {{ $id_post }} " likes=" {{ $likes }} " countlike=" {{ $countLike }} "></like-button>
                            <form class="form-comment-post"  action=" {{route('posts.comment',$id_post)}} " method="post">
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
@endsection
