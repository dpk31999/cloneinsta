@extends('layouts.app')
@section('content')
<div class="container" style="padding: 2% 10% 0;">
    <div class="row">
        <div class="col-8">
            @foreach ($posts as $post)
            <div class="border mb-5 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex mt-3">
                        <img class="rounded-circle" width="35px" height="35px" src="/thumbs/{{$post->user->profile->url_thumb}}" alt="">
                        <a class="pt-2" href=" {{route('profile.show' , $post->user->id)}} "><h5> {{$post->user->username}} </h5></a>
                    </div>
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <img class="w-100 mt-3" src="/storage/{{ $post->image }}" alt="">
                <p> {{$post->caption}} </p>
            </div>
            @endforeach
        </div>
        <div class="col-4">
            @if (isset($user))
            <div class="info d-flex pt-2 align-items-center">
                    <img class="rounded-circle" src="/thumbs/{{$user->profile->url_thumb}}" alt="" width="40px" height="40px">
                    <div class="name pl-2">
                        <h5>{{$user->username}}</h5>
                        <p>{{$user->name}}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection