@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row" style="padding: 2% 10% 0">
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
    <div class="row pt-2">
        <p style="color:teal">More post from <span class="font-weight-bold">{{ $user->username}}</span></p>
    </div>
    <div class="row mt-2">
        @foreach ($posts as $post)
            <div class="col-4 pd-2">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="" height="400">
            </div>
        @endforeach
    </div>
</div>   
@endsection