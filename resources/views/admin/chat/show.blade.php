@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-9" id="messages">
            
        </div>
        <div class="col-3 bg-white">
            <div class="user-wrapper" style="position: relative">
                @foreach ($admins as $admin)
                    <div class="d-flex" style="position: relative; padding: 10px;border-bottom: 1px solid black">
                        <div>
                            <strong>{{$admin->username}}</strong>
                            <p>{{$admin->get_role()->name}}</p>
                        </div>
                        <div style="position: absolute; right: 10px">
                            Online
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
