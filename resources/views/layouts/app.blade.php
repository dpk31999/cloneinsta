<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div class="pl-5"><img src="/png/logo.png" alt="" style="height: 30px; color:black;"></div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $('.form-comment').submit(function(e){
                $form = $(this); //wrap this in jQuery
                var route = $form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: $(this).serialize(),
                    success: function(data){
                        if(data.comment){
                            var id = data.id_post;
                            var set = '#comments' + id;
                            console.log(data.id_comment);
                            $(set).append('<div class="d-flex bd-highlight"><div class="p-2 flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="/profile/'+ data.id +'"><strong>'+ data.username +'</strong></a>'+ ' ' + data.comment  +'</div>' + '<div class="d-flex" style="position: relative;"><div class="p-2 bd-highlight" style="position: absolute; bottom: 3px;"><button id="like1" class="btn btn-primary">Like</button></div> <div class="p-2 bd-highlight"><strong> 0 </strong>Likes</div></div></div>');
                            $('.commentInput').val('');
                        }
                    }
                });
            });

            $('.form-comment-post').submit(function(e){
                $form = $(this); //wrap this in jQuery
                var route = $form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: $(this).serialize(),
                    success: function(data){
                        if(data.comment){
                            $('#comments').append('<div><img  witdh="30px" height="30px" src="/thumbs/' + data.url_thumb + '" style="border-radius: 50%;" alt=""><strong>'+ data.username +'</strong>'+ ' ' + data.comment  +'</div>' + '<div style="font-size:12px; margin-left: 30px">Just now</div>');
                            $('.commentInput').val('');
                        }
                    }
                });
            });

            $('.reply').one('click',function(){
                var reply_id = $(this).attr('id');
                var arr = reply_id.split('reply');
                var id = parseInt(arr[0]+arr[1]);
                var set = '#replyComment' + id;
                $(set).removeClass('d-none');
            });
            
            $('.form-reply-comment').submit(function(e){
                $form = $(this); 
                var route = $form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: $(this).serialize(),
                    success: function(data){
                        var id = data.id_comment;
                        var set = '#replys' + id;
                        $(set).append('<div class="d-flex"><a href="/profile/'+ data.user.id +'"><img witdh="30px" height="30px" src="/thumbs/' + data.url_thumb + '" alt="" style="border-radius: 50%;"></a><div class="ml-3"><a class="text-decoration-none text-dark" href="/profile/'+ data.user.id +'"><strong>'+ data.user.username +'</strong></a>'+ ' ' + data.replyCmt  +'</div></div>');
                        $('.replyInput').val('');
                    }
                });
            });
        });
    </script>
</body>
</html>
