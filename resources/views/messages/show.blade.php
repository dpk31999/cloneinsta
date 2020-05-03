@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 bg-white">
                <div class="row">
                    <div class="col-6">
                        <div class="item bg-info" id="mess_reccent" style="border: 1px solid black; text-align: center; cursor: pointer">
                            Reccent 
                            @if ($count_mess)
                            <span id="parent_m">
                                (<span id="countM">{{$count_mess}}</span>)
                            </span>
                            @endif 
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item" id="mess_request" style="border: 1px solid black; text-align: center;cursor: pointer">
                            Message Request 
                            @if ($count_request)
                            <span id="parent_r">
                                (<span id="countR">{{$count_request}}</span>)
                            </span>
                            @endif 
                        </div>
                    </div>
                </div>
                <div class="user-wrapper" style="position: relative">
                    @if (isset($user) == false)
                        <h4 style="position: absolute;top: 20%;left:10%;">You don't have reccent message!</h4>
                    @else
                    <ul class="users">
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
                    </ul>
                    @endif
                </div>
            </div>

            <div class="col-8" id="messages">

            </div>
        </div>
    </div>
@endsection
