<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
        .loader {
            position: absolute;
            left: 44%;
            top: 45%;
            border: 5px solid #d9d9d9;
            border-radius: 50%;
            border-top: 5px solid black;
            width: 50px;
            height: 50px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        .loader1 {
            position: absolute;
            left: 44%;
            top: 45%;
            border: 5px solid #d9d9d9;
            border-radius: 50%;
            border-top: 5px solid black;
            width: 50px;
            height: 50px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        .loader2 {
            position: relative;
            left: 44%;
            top: 10px;
            border: 2px solid #d9d9d9;
            border-radius: 50%;
            border-top: 3px solid black;
            width: 40px;
            height: 40px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .link-info:hover{
            background-color: #eeeeee;
        }

        .lds-spinner {
        color: official;
        display: inline-block;
        position: relative;
        width: 50px;
        height: 15px;
        }
        .lds-spinner div {
        transform-origin: 40px 40px;
        animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
        content: " ";
        display: block;
        position: absolute;
        top: 3px;
        left: 37px;
        width: 2px;
        height: 4px;
        border-radius: 20%;
        background: #fff;
        }
        .lds-spinner div:nth-child(1) {
        transform: rotate(0deg);
        animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
        transform: rotate(30deg);
        animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
        transform: rotate(60deg);
        animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
        transform: rotate(90deg);
        animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
        transform: rotate(120deg);
        animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
        transform: rotate(150deg);
        animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
        transform: rotate(180deg);
        animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
        transform: rotate(210deg);
        animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
        transform: rotate(240deg);
        animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
        transform: rotate(270deg);
        animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
        transform: rotate(300deg);
        animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
        transform: rotate(330deg);
        animation-delay: 0s;
        }
        @keyframes lds-spinner {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
        }

    </style>
</head>
<body>
    <?php 
        if(auth()->user())
        {
        $count_noti = DB::table('notifications')->where([
            ['to',auth()->user()->id],
            ['is_read','0']
        ])->get()->count();
        $arr_follow = auth()->user()->following->pluck('user_id');
        $count_mess = DB::table('messages')->whereIn('from',$arr_follow)->where([
            ['to',auth()->user()->id],
            ['is_read','0']
        ])->distinct()->pluck('from')->count();
        $count_request = DB::table('messages')->whereNotIn('from',$arr_follow)->where([
            ['to',auth()->user()->id],
            ['is_read','0']
        ])->distinct()->pluck('from')->count();
        }
    ?>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5" style="position: fixed;width: 100%;z-index: 1">
            <div class="container">
                <a class="navbar-brand d-flex mr-5" href="{{ url('/') }}">
                    <div class="pl-5"><img src="/png/logo.png" alt="" style="height: 30px; color:black;"></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                            
                    @else 
                    @if (auth()->user()->profile)
                    <ul class="navbar-nav mr-auto ml-5">
                            <div class="content">
                                <form class="typeahead" role="search">
                                    <input type="search" name="q" class="form-control search-input" placeholder="Type something..." autocomplete="off">
                                </form>
                            </div>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <a class="nav-link" id="home" href="{{ url('/') }}"><i class="fas fa-home fa-2x mr-3"></i></a>
                        <div style="position: relative">
                            <div id="parent_pending1" style="position: absolute;top: -10px;left: 15px">
                                @if ($count_mess > 0)
                                    <span id="count_mess" class="pending">{{$count_mess}}</span>
                                @endif
                            </div>
                            <a class="nav-link" id="message" href="{{ route('message') }}"><i class="fas fa-inbox fa-2x mr-3"></i></a>
                        </div>
                        <div style="position: relative">
                            <div id="parent_pending" style="position: absolute;top: -10px;left: 15px">
                                @if ($count_noti > 0)
                                    <span id="count_noti" class="pending">{{$count_noti}}</span>
                                @endif
                            </div>
                            <a class="nav-link" id="noti"><i class="fas fa-heart fa-2x mr-3"></i>
                                
                            </a>
                            <div id="dropnoti" class="bg-white border rounded shadow overflow-auto" style="width: 400px;height: 500px;position: absolute;top:50px;z-index: 1;right: -40px;display: none">
                                
                            </div>
                        </div>
                    </ul>
                    
                    @endguest
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                @if (auth()->user()->profile)
                                @if (auth()->user()->profile->url_thumb != '')
                                <a href="{{route('profile.show',auth()->user()->id)}}">
                                    <img src="/thumbs/{{auth()->user()->profile->url_thumb}}" style="border-radius: 50%" width="30px" height="30px" alt="">
                                </a>
                            @else
                                <a href="{{route('profile.show',auth()->user()->id)}}">
                                    <img src="/thumbs/default_ava.jpg" style="border-radius: 50%" width="30px" height="30px" alt="">
                                </a>
                            @endif
                                @endif
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5" id="body" style="position: relative;top:50px">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/message.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/realtime.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script type="text/javascript">
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        var token = "{{ csrf_token() }}";
        var mouse_is_inside = false;
        var arr_user = [];
        var startNoti = 0;
        var actionNoti = 'inactive';
        var startPost = 0;
        var actionPost = 'inactive';
        var arr = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
