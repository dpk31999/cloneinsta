<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css" media="all"> --}}
    {{-- <link href=" {{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href=" {{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href=" {{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href=" {{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href=" {{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href=" {{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">  --}}

    <!-- Main CSS-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img style="background-color: #f5f5f5" src="/png/logo.png" alt="" />
                </a>
            </div>
            
            @if(Auth::guard('admin')->check())
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.user')}}">
                                <i class="fas fa-chart-bar"></i>User</a>
                        </li>
                        <li>
                            <a href="{{route('admin.post')}}">
                                <i class="fas fa-table"></i>Post</a>
                        </li>
                        <li>
                            <a href="{{route('admin.report')}}">
                                <i class="far fa-check-square"></i>Report</a>
                        </li>
                        <li>
                            <a href="{{route('admin.chat')}}">
                                <i class="fas fa-calendar-alt"></i>Room Chat</a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasRole('superadmin'))
                        <li>
                            <a href="{{route('admin.setting')}}">
                                <i class="fas fa-map-marker-alt"></i>Setting Manager</a>
                        </li>
                        @endif
                    
                    </ul>
                </nav>
            </div>
            @endif
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            @if(Auth::guard('admin')->check())
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="content">
                                <a class="js-acc-btn" href="#" 
                                onclick="event.preventDefault(); document.querySelector('#admin-logout-form').submit();" >
                                Logout</a>

                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            @endif
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        @if(Auth::guard('admin')->check())
                                        {{-- <div class="image">
                                            <img src="thumbs/default_ava.jpg" alt="John Doe" />
                                        </div> --}}
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::guard('admin')->user()->name}}</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <div class="main-content">
                @yield('content')
            <div></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- <!-- Jquery JS-->
    {{-- <script src=" {{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src=" {{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    {{-- <script src=" {{ asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/wow/wow.min.js') }}"></script>
    <script src=" {{ asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src=" {{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src=" {{ asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src=" {{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src=" {{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src=" {{ asset('vendor/select2/select2.min.js') }}">
    </script> --}}

    <!-- Main JS-->
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $(document).ready(function(){
            $('#form_add_admin').on('submit', function(e){
                e.preventDefault();
                // var username = $('#username').val();
                // var name = $('#name').val();
                // var email = $('#email').val();
                // var selectrole = $('#select').val();
                // var password = $('#password').val();
                // var 
                $.ajax({
                    method: 'post',
                    url: 'addAdmin',
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        document.getElementById('close').click();
                        $('#tbody').append('<tr class="admin" data-id="'+ data.admin.id +'"><td>'+ data.admin.created_at +'</td><td>'+ data.admin.username +'</td><td>'+ data.admin.name +'</td><td>'+ data.role +'</td></tr>');
                    },
                    error: function(xhr, status, data){
                        for(var p in xhr.responseJSON.errors){
                            $('#error' + `${p}`).html(`${xhr.responseJSON.errors[p]}`);
                        }
                    }
                });
            });

            $("input").keyup(function(){
                $("p").html('');
            });

            $('.admin').on('contextmenu', function(e) {
                var admin_id = $(this).data('id');
                $('#context-menu').find('a[id="delete"]').attr('data-admin-id',admin_id);
                $('#context-menu').find('a[data-id="edit"]').attr('id', admin_id);
                var top = e.pageY - 10;
                var left = e.pageX - 90;
                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                }).addClass("show");
                return false; //blocks default Webbrowser right click menu
                }).on("click", function() {
                $("#context-menu").removeClass("show").hide();
                });

                $("#context-menu a").on("click", function() {
                $(this).parent().removeClass("show").hide();
            });

            $(document).click(function(event) { 
            $target = $(event.target);
            if(!$target.closest('#context-menu').length && 
            $('#context-menu').is(":visible")) {
                $('#context-menu').hide();
            }        
            });

            $('#delete').on('click',function(e){
                $confirm = confirm('You want delete this admin ? !!!');
                if($confirm == false){
                    return false;
                }
                var admin_id = $(this).data('admin-id');
                $.ajax({
                    method: 'post',
                    url : 'deleteAdmin',
                    data: {admin_id:admin_id},
                    cache: false,
                    success: function(data){
                        $("#context-menu").hide();
                        $('#tbody').find('tr[data-id="'+ admin_id +'"]').remove();
                    }
                });
            });

            $('.edit').on('click',function(){
                var admin_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'getAdmin/'+ admin_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $("#modalEdit").modal('show');
                        $('.form_edit_admin').attr('id',admin_id);
                        $('#usernameedit').val(data.admin.username);
                        $('#nameedit').val(data.admin.name);
                        $('#emailedit').val(data.admin.email);
                        $('#selectedit').val(data.role);
                        $('#passwordedit').val(data.admin.password);
                        $('#confirmpasswordedit').val(data.admin.password);
                    }
                });
            });

            $('.form_edit_admin').on('submit', function(e){
                e.preventDefault();
                var admin_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url: 'editAdmin/' + admin_id,
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        document.getElementById('closeEdit').click();
                        $('#create' + admin_id).html(data.admin.created_at);
                        $('#username' + admin_id).html(data.admin.username);
                        $('#name' + admin_id).html(data.admin.nam);
                        $('#role' + admin_id).html(data.role);
                    },
                    error: function(xhr, status, data){
                        for(var p in xhr.responseJSON.errors){
                            $('#error' + `${p}`).html(`${xhr.responseJSON.errors[p]}`);
                        }
                    }
                });
            });

            $('.user').on('contextmenu', function(e) {
                var user_id = $(this).data('id');
                $('#context-menu').find('a[data-id="view"]').attr('id', 'view' + user_id);
                $('#context-menu').find('a[data-id="block"]').attr('id', 'block' + user_id);
                var top = e.pageY - 10;
                var left = e.pageX - 90;
                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                }).addClass("show");
                return false; //blocks default Webbrowser right click menu
                }).on("click", function() {
                $("#context-menu").removeClass("show").hide();
                });

                $("#context-menu a").on("click", function() {
                $(this).parent().removeClass("show").hide();
            });

            $('.block').on('click', function(){
                var user_id = $(this).attr('id');
                var arr = user_id.split('block');
                var id = parseInt(arr[0]+arr[1]);
                $.ajax({
                    method: 'post',
                    url: 'blockUser/' + id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#status' + id).html(data.status)
                        if(data.status == 'Block'){
                            $('#tbody').find('tr[data-id="'+ id +'"]').css('background-color', '#ffb3b3');
                        }
                        else{
                            $('#tbody').find('tr[data-id="'+ id +'"]').css('background-color', '');
                        }
                    }
                });
            });

            $('.view').on('click',function(){
                var user_id = $(this).attr('id');
                var arr = user_id.split('view');
                var id = parseInt(arr[0]+arr[1]);
                $.ajax({
                    method: 'post',
                    url : 'getUser/'+ id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $("#modalView").modal('show');
                        $('#name').html(data.user.name);
                        $('#username').html(data.user.username);
                        $('#email').html(data.user.email);
                        $('#provider').html(data.user.provider);
                        $('#status').html(data.status);
                        $('#posts').html(data.count_post);
                        $('#following').html(data.count_following);
                        $('#follower').html(data.count_follower);
                    }
                });
            });

            $('.report').on('click', function(){
                var report_id = $(this).attr('id');
                var arr = report_id.split('report');
                var id = parseInt(arr[0]+arr[1]);
                $.ajax({
                    method: 'get',
                    url: 'getReport/' + id,
                    data: "",
                    cache: false,
                    success: function(data)
                    {
                        $('#modalViewReport').modal('show');
                        $('#name').html(data.name);
                        $('#email').html(data.email);
                        $('#data_create').html(data.report.created_at);
                        $('#content').html(data.report.content_report);
                        $('#read' + id).html('Seen');
                    }
                });
            });
        });
    </script>

</body>

</html>
<!-- end document-->
