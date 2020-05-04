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
        $(document).ready(function(){
            var origin   = window.location.origin;
            var href = window.location.href;
            var my_id = "{{ Auth::id() }}";
            var token = "{{ csrf_token() }}";
            var receiver_id = '';
            var mouse_is_inside = false;
            var arr_user = [];
            var startNoti = 0;
            var actionNoti = 'inactive';
            var startPost = 0;
            var actionPost = 'inactive';
            var arr = [];
            var newhref =  href.substring(0, href.length - 1);
            
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // $(document).pjax('a', '#body');
        // if ($.support.pjax) {
        //     $.pjax.defaults.timeout = 12000; // time in milliseconds
        // }

        if(window.location.pathname == ''){
            startPost = 0;
            actionPost = 'inactive';
        }


        $('#form_report').on('submit',function(e){
            e.preventDefault();
            $('#btn_send_report').html('Waiting...');
            var origin   = window.location.origin;
            var content_report =  $('#content_report').val();
            $.ajax({
                method: 'post',
                url: origin + '/report',
                data: {content_report:content_report},
                cache: false,
                success: function(data){
                    $('#content_report').val('');
                    $('#btn_send_report').html('Send Report');
                    $('#btn_send_report').attr('data-dismiss', 'modal');
                    $('#btn_send_report').attr('data-toggle', 'modal');
                    $('#btn_send_report').attr('data-target', '#ModalThank');
                    document.getElementById('btn_send_report').click();
                    $('#btn_send_report').removeAttr("data-dismiss");    
                    $('#btn_send_report').removeAttr("data-toggle");
                    $('#btn_send_report').removeAttr("data-target");
                }
            });
        });

        $(document).on("click", ".open-AddBookDialog", function () {
            var origin   = window.location.origin;
            var post_id = $(this).data('post-id');
            var image = $(this).data('image');
            var name = $(this).data('name');
            var user_id = $(this).data('user-id');
            $(".content").find('a[id="go_post"]').attr('href',origin + '/p/' + post_id);
            $(".content").find('img[id="img_in_post"]').attr('src',origin + '/thumbs/' + image);
            $(".content").find('div[id="name_in_post"]').html('@' + name + '?');
            $(".modal-body").find('div[data-id="spam"]').attr('id', 'spam' + post_id);
            $(".content").find('div[id="unfollow"]').attr('data-id',user_id);
            $(".modal-body").find('div[data-id="inapproprite"]').attr('id','inapproprite' + post_id);
            $(".modal-body").find('form[data-id="form"]').attr('id',  'report' + post_id);
            $(".content").find('a[id="unfl"]').attr('data-id', user_id);

            if(arr.includes(user_id)){
                $('#unfl').hide();
            }
            else{
                $('#unfl').show();
            }
        });

        $('#unfollow').on('click',function(){
            var user_id = $(this).data('id');
            $.ajax({
                method: 'post',
                url: '/follow/' + user_id,
                data: '',
                cache: false,
                success: function(data){
                    document.getElementById('cancel').click();
                    $('#unfl').hide();
                    arr.push(user_id);
                    $(".d-flex").find('div[data-user-id="'+ user_id +'"]').append('<a data-user-id="'+ user_id +'" class="text-decoration-none pt-2 follow-in-post" style="color:#b3b3ff;cursor: pointer" id="followInPost">&nbspFollow</a>')
                    $('.follow-in-post').on('click',function(){
                        var user_id = $(this).data('user-id');
                        arr.splice(arr.indexOf(user_id),1);
                        $.ajax({
                            method: 'post',
                            url: '/follow/' + user_id,
                            data: '',
                            cache: false,
                            success: function(data){
                                $('#unfl').show();
                                $('.follow-in-post').remove();
                            }
                        });
                    });
                }
            });
        });

        $('.spam').on('click',function(){
            var origin   = window.location.origin;
            var id = $(this).attr('id');
            var arr = id.split('spam');
            var post_id = parseInt(arr[0]+arr[1]);
            var type = $(this).html();
            var content_report = '';
            $.ajax({
                method: 'post',
                url: origin + '/reportPost',
                data: {post_id:post_id,type:type,content_report:content_report},
                cache: false,
                success: function(data){
                    $('#close').attr('data-toggle', 'modal');
                    $('#close').attr('data-target', '#ModalThankPost');
                    document.getElementById('close').click();
                    $('#close').removeAttr("data-toggle");
                    $('#close').removeAttr("data-target");
                }
            });
        });

        $('.form_report_post').on('submit',function(e){
            e.preventDefault();
            $('#btn_send_report').html('Waiting...');
            var origin   = window.location.origin;
            var id = $(this).attr('id');
            console.log(id);
            var arr = id.split('report');
            var post_id = parseInt(arr[0]+arr[1]);
            
            var type = "It's inapproprite";
            var content_report = $('#content_report').val();
            $.ajax({
                method: 'post',
                url: origin + '/reportPost',
                data: {post_id:post_id,type:type,content_report:content_report},
                cache: false,
                success: function(data){
                    $('#content_report').val('');
                    $('#btn_send_report').html('Send Report');
                    $('#btn_send_report').attr('data-dismiss', 'modal');
                    $('#btn_send_report').attr('data-toggle', 'modal');
                    $('#btn_send_report').attr('data-target', '#ModalThankPost');
                    document.getElementById('btn_send_report').click();
                    $('#btn_send_report').removeAttr("data-dismiss");    
                    $('#btn_send_report').removeAttr("data-toggle");
                    $('#btn_send_report').removeAttr("data-target");
                }
            });
        });

        //post

        $('.reply').one('click',function(){
            var reply_id = $(this).attr('id');
            var arr = reply_id.split('reply');
            var id = parseInt(arr[0]+arr[1]);
            var set = '#replyComment' + id;
            $(set).removeClass('d-none');
            });

            $('.like-post').on('click',function(){
                var id_post = $(this).attr('id');
                var arr = id_post.split('like');
                var id = parseInt(arr[0]+arr[1]);
                console.log(id);
                console.log($(this).html());
                var count_like =  parseInt($('#count_like'+ id).html());   
                if($(this).html() == 'UnLike'){
                    $(this).html('Like');
                    $('#count_like'+ id).html(count_like -1);
                }
                else{
                    $(this).html('UnLike');
                    $('#count_like'+ id).html(count_like + 1);
                }

                $.ajax({
                    type: 'post',
                    url: '/like/' + my_id + '/post/' + id,
                    data: '',
                    cache: false,
                    success: function(data){

                    }
                });
            });

            $('#like').on('click',function(){
                var id_post = $(this).data('id');
                var count_like =  parseInt($('#count_like'+ id_post).html());   
                if($(this).html() == 'UnLike'){
                    $(this).html('Like');
                    $('#count_like'+ id_post).html(count_like -1);
                }
                else{
                    $(this).html('UnLike');
                    $('#count_like'+ id_post).html(count_like + 1);
                }

                $.ajax({
                    type: 'post',
                    url: '/like/' + my_id + '/post/' + id_post,
                    data: '',
                    cache: false,
                    success: function(data){

                    }
                });
            });

            $('.like-comment').on('click',function(){
                var id_comment = $(this).attr('id');
                var arr = id_comment.split('likeCmt');
                var id = parseInt(arr[0]+arr[1]);
                var count_like =  parseInt($('#count_like_cmt'+ id).html());
                if($(this).html() == 'UnLike'){
                    $(this).html("Like");
                    $('#count_like_cmt'+ id).html(count_like -1);
                }
                else{
                    $(this).html("UnLike");
                    $('#count_like_cmt'+ id).html(count_like + 1);
                }

                $.ajax({
                    type: 'post',
                    url: '/like/' + my_id + '/comment/' + id,
                    data: '',
                    cache: false,
                    success: function(data){

                    }
                });
            });

            $('.like-comment-post').on('click',function(){
                var id_comment = $(this).data('id');
                var count_like =  parseInt($('#count_like_cmt'+ id_comment).html());
                if($(this).html() == 'UnLike'){
                    $(this).html("Like");
                    $('#count_like_cmt'+ id_comment).html(count_like -1);
                }
                else{
                    $(this).html("UnLike");
                    $('#count_like_cmt'+ id_comment).html(count_like + 1);
                }

                $.ajax({
                    type: 'post',
                    url: '/like/' + my_id + '/comment/' + id_comment,
                    data: '',
                    cache: false,
                    success: function(data){

                    }
                });
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
                            $('.commentInput').val('');
                        }
                    }
                });
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
                        $('.replyInput').val('');
                    }
                });
            });

            $(window).scroll(function(){
                if($(window).scrollTop() + $(window).height() > $('#show_post').height() && actionPost == 'inactive'){
                    $('#show_post').append('<div class="loader2"></div>');
                    actionPost = 'active';
                    startPost = startPost + 3;
                    load_post(startPost);
                } 
            });

            $('#show_post').html('<div id="asd">Waiting ...</div>')

            function load_post(startPost){
                $post_show = $('#show_post');
                if($post_show){
                    $.ajax({
                        method: 'post',
                        url: origin + '/getpost',
                        data: {start:startPost},
                        cache: false,
                        success: function(data){
                            $('#save_arr').children('p').each(function () {
                                console.log(this.html); // "this" is the current element in the loop
                            });
                            if(data == ''){
                                $('#show_post').append('<div>Het roi :<</div>');
                            }
                            if($('#asd')){
                                $('#asd').remove();
                            }
                            $('.loader2').remove();
                            $('#show_post').append(data);
                            $('.like-post').on('click',function(){
                                var id_post = $(this).attr('id');
                                var arr = id_post.split('like');
                                var id = parseInt(arr[0]+arr[1]);
                                var count_like =  parseInt($('#count_like'+ id).html());   
                                if($(this).html() == 'UnLike'){
                                    $(this).html("Like");
                                    $('#count_like'+ id).html(count_like -1);
                                }
                                else{
                                    $(this).html("UnLike");
                                    $('#count_like'+ id).html(count_like + 1);
                                }
                            
                                $.ajax({
                                    type: 'post',
                                    url: '/like/' + my_id + '/post/' + id,
                                    data: '',
                                    cache: false,
                                    success: function(data){
                            
                                    }
                                });
                            });
                            
                            $('.like-comment').on('click',function(){
                                var id_comment = $(this).attr('id');
                                var arr = id_comment.split('likeCmt');
                                var id = parseInt(arr[0]+arr[1]);
                                var count_like =  parseInt($('#count_like_cmt'+ id).html());
                                if($(this).html() == 'UnLike'){
                                    $(this).html("Like");
                                    $('#count_like_cmt'+ id).html(count_like -1);
                                }
                                else{
                                    $(this).html("UnLike");
                                    $('#count_like_cmt'+ id).html(count_like + 1);
                                }
                            
                                $.ajax({
                                    type: 'post',
                                    url: '/like/' + my_id + '/comment/' + id,
                                    data: '',
                                    cache: false,
                                    success: function(data){
                            
                                    }
                                });
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
                                            $('.commentInput').val('');
                                        }
                                    }
                                });
                            });
                            if(data == ''){
                                actionPost = 'active';
                            }
                            else{
                                actionPost = 'inactive';
                            }
                        }
                    });
                }
            }
            
            if(typeof my_id !== 'undefined' && newhref == origin)
            {
                load_post(startPost);
            }

            //realtime
            Pusher.logToConsole = true;

            var pusher = new Pusher('e85b431a16d3cfe78949', {
            cluster: 'ap1',
            forceTLS: true
            });

            var channel = pusher.subscribe('channel-message');
            
            channel.bind('event-message', function (data) {
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        var count_mess = parseInt($('#count_mess').html());
                        
                        if(arr_user.indexOf(data.from) === -1 && data.check === true){
                            if(count_mess){
                                $('#count_mess').html(count_mess + 1);
                            }
                            else{
                                $('#parent_pending1').append('<span id="count_mess" class="pending">1</span>');
                            }
                            arr_user.push(data.from);
                        }

                        

                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());

                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            var chanel1 = pusher.subscribe('my-channel');
            chanel1.bind('my-event', function(data){
                if(data.from != data.to){
                    if(my_id == data.to){
                        var count_noti = parseInt($('#count_noti').html());
                        if(count_noti){
                            $('#count_noti').html(count_noti+1);
                        }
                        else{
                            $('#parent_pending').append('<span id="count_noti" class="pending">1</span>');
                        }
                    }
                }

            });

            var channelCmt = pusher.subscribe('channel-cmt');
            channelCmt.bind('event-cmt',function(data){
                var arr = data.arr_comments;
                // post->id send other user
                if(arr.indexOf(parseInt(my_id)) !== -1){
                    var count_noti = parseInt($('#count_noti').html());
                    if(count_noti){
                    $('#count_noti').html(count_noti+1);
                    }
                    else{
                        $('#parent_pending').append('<span id="count_noti" class="pending">1</span>');
                    }
                }
                // if id from different id to
                else if(data.from != data.to){
                    if(my_id == data.to){
                        var count_noti = parseInt($('#count_noti').html());
                        if(count_noti){
                        $('#count_noti').html(count_noti+1);
                        }
                        else{
                            $('#parent_pending').append('<span id="count_noti" class="pending">1</span>');
                        }
                    }
                }
                // add cmt in home 
                var set = '#comments' + data.id_post;
                // add cmt in post
                var set1 = '#comments';
                if($(set)) {
                    // if isset set then append comment
                    $(set).append('<div class="d-flex bd-highlight mb-2"><div class="p-2 flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="/profile/'+ data.from +'"><strong>'+ data.username +'</strong></a>'+ ' ' + data.comment  +'</div>' + '<div class="p-2 bd-highlight" style="position: absolute; bottom: 3px;"></div><button id="likeCmt'+ data.id_comment +'" class="btn btn-primary like-comment">Like</button></div>')
                    
                    //
                    $(set).on('click','#likeCmt'+ data.id_comment,function(){
                        //get comment->id
                        var id_comment = $(this).attr('id');
                        var arr = id_comment.split('likeCmt');
                        var id = parseInt(arr[0]+arr[1]);

                        //get count_like 
                        var count_like =  parseInt($('#count_like_cmt'+ id).html());
                        if($(this).html() == 'UnLike'){
                            $(this).html("Like");
                            $('#count_like_cmt'+ id).html(count_like -1);
                        }
                        else{
                            $(this).html("UnLike");
                            $('#count_like_cmt'+ id).html(count_like + 1);
                        }

                        // send ajax to uppdate db
                        $.ajax({
                            type: 'post',
                            url: '/like/' + my_id + '/comment/' + id,
                            data: '',
                            cache: false,
                            success: function(data){

                            }
                        });
                    });
                }
                if($(set1)){
                    $(set1).append('<div class="d-flex" style="position: relative"><a href="/profile/'+ data.from +'"><img  witdh="30px" height="30px" src="/thumbs/' + data.url_thumb + '" style="border-radius: 50%;" alt=""></a><div><div class="d-flex bd-highlight mb-2"><div class="flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="/profile/'+ data.from +'"><strong>'+ data.username +'</strong></a>'+ ' ' + data.comment  +'</div><button style="position: absolute;top: 0%;right: 2%;" id="likeCmt'+ data.id_comment +'" class="btn btn-primary like-comment">Like</button></div><div class="d-flex"><div style="font-size:12px">just now</div><div class="reply" id="reply'+ data.id_comment +'" >&nbsp&nbspReply</div><div class="ml-2"><strong id="count_like_cmt'+ data.id_comment +'">0</strong> Likes</div></div><div id="replys'+ data.id_comment +'"></div><form class="d-none form-reply-comment" data-id="'+ data.id_comment +'" id="replyComment'+ data.id_comment +'" action="/replyCmt/'+ data.id_comment +'" method="post"><input type="hidden" name="_token" value="'+ token +'"><input class="form-control replyInput" type="text" id="replyCmt" name="replyCmt" placeholder="Write a reply..." style="height: 30px" required><input type="hidden" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/></form></div></div>')
                    $(set1).on('click','#likeCmt'+ data.id_comment,function(){
                        var id_comment = $(this).attr('id');
                        var arr = id_comment.split('likeCmt');
                        var id = parseInt(arr[0]+arr[1]);
                        var count_like =  parseInt($('#count_like_cmt'+ id).html());
                        if($(this).html() == 'UnLike'){
                            $(this).html("Like");
                            $('#count_like_cmt'+ id).html(count_like -1);
                        }
                        else{
                            $(this).html("UnLike");
                            $('#count_like_cmt'+ id).html(count_like + 1);
                        }

                        $.ajax({
                            type: 'post',
                            url: '/like/' + my_id + '/comment/' + id,
                            data: '',
                            cache: false,
                            success: function(data){

                            }
                        });
                    });

                    // show form reply comment
                    $('.reply').one('click',function(){
                        var reply_id = $(this).attr('id');
                        var arr = reply_id.split('reply');
                        var id = parseInt(arr[0]+arr[1]);
                        console.log(id);
                        var set = '#replyComment' + id;
                        $(set).removeClass('d-none');
                    });

                    // handle form reply
                    $('.form-reply-comment').submit(function(e){
                        $form = $(this); 
                        var route = $form.attr('action');
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: route,
                            data: $(this).serialize(),
                            success: function(data){
                                $('.replyInput').val('');
                            }
                        });
                    });
                }
            });

            var channelRepCmt = pusher.subscribe('channel-rep-cmt');
            channelRepCmt.bind('event-rep-cmt',function(data){
                var id = data.id_comment;
                var set = '#replys' + id;
                if(data.from != data.to){
                    if(my_id == data.to){
                        var count_noti = parseInt($('#count_noti').html());
                        if(count_noti){
                        $('#count_noti').html(count_noti+1);
                        }
                        else{
                            $('#parent_pending').append('<span id="count_noti" class="pending">1</span>');
                        }
                    }
                }
                $(set).append('<div class="d-flex"><a href="/profile/'+ data.from +'"><img witdh="30px" height="30px" src="/thumbs/' + data.url_thumb + '" alt="" style="border-radius: 50%;"></a><div class="ml-3"><a class="text-decoration-none text-dark" href="/profile/'+ data.from +'"><strong>'+ data.username +'</strong></a>'+ ' ' + data.replyCmt  +'</div></div>');
            });

            // search

            var engine1 = new Bloodhound({
                remote: {
                    url: '/search?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-input").typeahead({
                hint: true,
            }, [
                {
                    source: engine1.ttAdapter(),
                    name: 'students-name',
                    display: function(data) {
                        return data.name;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title mt-2" style="width: 220px;"></div><div class="list-group search-results-dropdown"><div class="list-group-item">No result found.</div></div>'
                        ],
                        header: [
                            '<div class="header-title mt-2" style="width: 220px;></div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/profile/' + data.id + '" class="list-group-item text-decoration-none text-dark link-info"><div><div><strong>' + data.username + '</strong></div><div>'+ data.name +'</div></div></a>';
                        }
                    }
                }, 
            ]);   

            // notification

            function load_noti(startNoti){
                $.ajax({
                    url : origin + "/notification",
                    method: "post",
                    data: {start:startNoti},
                    cache: false,
                    success: function(data){
                        $('.loader').remove();
                        $('.loader2').remove();
                        $('#count_noti').remove();
                        $('#dropnoti').append(data);
                        if(data == ''){
                            $('#dropnoti').append('<a class="text-decoration-none" style="position:absolute;left:40%" href="'+ origin +'/notification">See more</a>')
                            actionNoti = 'active';
                        }
                        else{
                            actionNoti = 'inactive';
                        }
                    }
                });
            }
            
            $('#noti').on('click',function(){
                var origin   = window.location.origin;
                $('#dropnoti').toggle();
                $('#dropnoti').html('<div class="loader"></div>');
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                load_noti(startNoti);
            });
            
            $('#dropnoti').scroll(function(){
                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight && actionNoti == 'inactive') {
                    $('#dropnoti').append('<div class="loader2"></div>');
                    actionNoti = 'active';
                    startNoti = startNoti + 10;
                    load_noti(startNoti);
                }
            })
            
            $('#dropnoti').hover(function(){ 
                mouse_is_inside=true; 
            }, function(){ 
                mouse_is_inside=false; 
            });
            
            $("body").mouseup(function(){ 
                if(! mouse_is_inside) 
                $('#dropnoti').hide()
                $('.nav-link').removeClass('active')
                startNoti = 0;
                
                ;
            });

            //message

            $('.user').click(function () {
                // $('#messages').html('<div class="loader"></div>');
                $('.user').removeClass('active');
                $(this).addClass('active');

                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#pen'+ receiver_id).remove();
                        var count_mess = parseInt($('#count_mess').html());
                        if(count_mess){
                            if(count_mess == 1){
                                $('#count_mess').remove();
                            }
                            else{
                                $('#count_mess').html(count_mess - 1);
                            }
                        }
                        var countM = parseInt($('#countM').html());
                        if(countM){
                            if(countM == 1){
                                $('#parent_m').remove();
                            }
                            else{
                                $('#countM').html(countM - 1);
                            }
                        }
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $('#mess_request').on('click',function(){
                $('.user-wrapper').html('<div class="loader1"></div>');
                $('.item').removeClass('bg-info');
                $(this).addClass('bg-info');
                $.ajax({
                    method: 'post',
                    url : 'request',
                    data: "",
                    cache: false,
                    success: function(data){
                        $('.user-wrapper').html(data);
                        $('.user').click(function () {
                            // $('#messages').html('<div class="loader"></div>');
                            $('.user').removeClass('active');
                            $(this).addClass('active');

                            receiver_id = $(this).attr('id');
                            $.ajax({
                                type: "get",
                                url: "message/" + receiver_id, // need to create this route
                                data: "",
                                cache: false,
                                success: function (data) {
                                    $('#pen'+ receiver_id).remove();
                                    var count_mess = parseInt($('#count_mess').html());
                                    if(count_mess){
                                        if(count_mess == 1){
                                            $('#count_mess').remove();
                                        }
                                        else{
                                            $('#count_mess').html(count_mess - 1);
                                        }
                                    }
                                    if(countR){
                                        if(countR == 1){
                                            $('#parent_r').remove();
                                        }
                                        else{
                                            $('#countR').html(countR - 1);
                                        }
                                    }
                                    $('#messages').html(data);
                                    scrollToBottomFunc();
                                }
                            });
                        });
                    }
                });
            });

            $('#mess_reccent').on('click',function(){
                $('.user-wrapper').html('<div class="loader1"></div>');
                $('.item').removeClass('bg-info');
                $(this).addClass('bg-info');
                $.ajax({
                    method: 'post',
                    url : 'reccent',
                    data: "",
                    cache: false,
                    success: function(data){
                        $('.user-wrapper').html(data);
                        $('.user').click(function () {
                            // $('#messages').html('<div class="loader"></div>');
                            $('.user').removeClass('active');
                            $(this).addClass('active');

                            receiver_id = $(this).attr('id');
                            $.ajax({
                                type: "get",
                                url: "message/" + receiver_id, // need to create this route
                                data: "",
                                cache: false,
                                success: function (data) {
                                    $('#pen'+ receiver_id).remove();
                                    var count_mess = parseInt($('#count_mess').html());
                                    if(count_mess){
                                        if(count_mess == 1){
                                            $('#count_mess').remove();
                                        }
                                        else{
                                            $('#count_mess').html(count_mess - 1);
                                        }
                                    }
                                    var countM = parseInt($('#countM').html());
                                    if(countM){
                                        if(countM == 1){
                                            $('#parent_m').remove();
                                        }
                                        else{
                                            $('#countM').html(countM - 1);
                                        }
                                    }
                                    $('#messages').html(data);
                                    scrollToBottomFunc();
                                }
                            });
                        });
                    }
                });
            });
            
            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {

                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });

            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight
                }, 50);
            }
        });
    </script>
</body>
</html>
