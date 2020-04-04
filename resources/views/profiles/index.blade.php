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
        <div class="modal-body" style="padding: 60px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-8" style="height: ">
                        <img class="w-100" src="/storage/{{ $image }}" alt="">
                    </div>
                    <div class="col-4">
                        <div class="header d-flex justify-content-between align-items-center">
                            <p class="pr-3" style="font-size:1vw;"> {{ $user->username}} </p>
                            <?php
                            if($user->profile->url_thumb != ''){
                                echo '<img witdh="30px" height="30px" src="/thumbs/' . $user->profile->url_thumb  .'" style="border-radius: 50%;" alt="">';
                            }
                            else{
                                echo '<img  witdh="30px" height="30px" src="/thumbs/default_ava.jpg" style="border-radius: 50%;" alt="">';
                            }
                            ?>
                            @if ($user->id != auth()->user()->id)
                            <a>Follow</a>
                            @endif
                        </div>
                        <hr>
                        <p> {{ $caption }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endif
@endsection
