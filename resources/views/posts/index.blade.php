@extends('layouts.app')
@section('content')
<div class="container" style="padding: 2% 10% 0;">
    <div class="row">
        <div class="col-sm-8">
            @foreach ($posts as $post)
            <div class="border mb-5 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex mt-3">
                        <a href=" {{route('profile.show' , $post->user->id)}} "><img class="rounded-circle" width="35px" height="35px" src="/thumbs/{{$post->user->profile->url_thumb}}" alt=""></a>
                        <a class="pt-2 text-decoration-none text-dark" href=" {{route('profile.show' , $post->user->id)}} "><p class="font-weight-bolder"> {{$post->user->username}} </p></a>
                    </div>
                    <div style="padding: 0 10px">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>
                <img class="w-100 mt-3" src="/storage/{{ $post->image }}" alt="">
                <div style="padding: 10px">
                    <div class="icon d-flex">
                        <?php 
                        $like = DB::table('post_user')->where([
                            ['user_id', auth()->user()->id],
                            ['post_id', $post->id],
                        ])->get();
                        $likes = false;
                        if($like->count() > 0){
                            $likes = true;
                        }

                        ?>
                        <like-button user-id=" {{ $post->user->id }} " post-id=" {{ $post->id }} " likes=" {{ $likes }} " countlike=" {{ $post->liked->count() }} "></like-button>
                    </div>
                    {{$post->caption}}
                    @if ($post->commented->count() > 2)
                        <div>
                            <a class="text-decoration-none" href=" {{route('posts.show', $post->id)}} ">View all {{$post->commented->count()}} comments</a>
                        </div>
                    @endif
                    <div id="comments{{$post->id}}">
                        @foreach ($post->commented->slice(0,2) as $comment)
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
                                <div class="p-2 flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="{{route('profile.show',$comment->user->id)}}"><strong>{{$comment->user->username}}</strong></a> {{$comment->content}}</div>
                                <like-comment user-id=" {{ $comment->user->id }} " comment-id=" {{ $comment->id }} " likes=" {{ $likesCm }} " countlike=" {{ $comment->likedCmt->count() }} "></like-comment>
                            </div>
                        @endforeach
                    </div>
                    <div style="font-size:12px">{{$post->getTime()}}</div>
                </div>
                <form class="form-comment" data-id="{{$post->id}}" action=" {{route('posts.comment',$post->id)}} " method="post">
                    @csrf
                    <div class="d-flex" style="position: relative">
                        <input class="form-control commentInput" type="text" id="comment" name="comment" placeholder="Add a comment..." style="height: 50px" required>
                        <input type="submit" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>
                        <div id="request_data"></div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        <div class="col-sm-4">
            @if (isset($user))
            <div class="info d-flex pt-2 align-items-center">
                <a  href="{{route('profile.show',auth()->user()->id)}}"><img class="rounded-circle" src="/thumbs/{{$user->profile->url_thumb}}" alt="" width="40px" height="40px"></a>
                <div class="name pl-2">
                    <a class="text-decoration-none text-dark" href="{{route('profile.show',auth()->user()->id)}}"><h5>{{$user->username}}</h5></a>
                    <p class="text-black-50">{{$user->name}}</p>
                </div>
            </div>
            @endif
            <div class="border bg-white">
                <div style="padding: 10px">
                    <div class="d-flex justify-content-between">
                        <span>
                            Suggestions For You
                        </span>
                        <a href="{{route('explore.show')}}">See All</a>
                    </div>
                    <div class="mt-2" style="overflow: auto">
                        @foreach ($arr_idUser as $userFl)
                            <div class="d-flex">
                                @if ($userFl[0]->url_thumb != '')
                                    <a href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/{{$userFl[0]->url_thumb}}" alt=""></a>
                                @else
                                    <a href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/default_ava.jpg" alt=""></a>
                                @endif
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <a class="text-decoration-none text-dark" href="{{route('profile.show',$userFl[0]->user->id)}}"><strong>{{$userFl[0]->user->username}}</strong></a>
                                        <?php
                                            $follow = DB::table('profile_user')->where([
                                                ['user_id', auth()->user()->id],
                                                ['profile_id', $userFl[0]->id],
                                            ])->get();
                                            $follows = false;
                                            if($follow->count() > 0){
                                                $follows = true;
                                            }
                                        ?>
                                        <follow-button user-id="{{$userFl[0]->user->id}}" follows="{{ $follows}}"></follow-button>
                                    </div>
                                    <div class="d-flex"><span style="font-size: 11px">Friend of {{$userFl[1]}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection