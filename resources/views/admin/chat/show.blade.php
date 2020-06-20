@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-9" id="messages">
        <div class="message-wrapper">
            <ul class="messages">
                @foreach ($messages as $message)
                    <li class="message clearfix">
                        <div class="{{ ($message->admin_id == Auth::guard('admin')->user()->id) ? 'sent' : 'received' }}">
                            <p>{{$message->message}}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
        <div class="col-3 bg-white" style="height: 450px;overflow-y :auto">
            <div style="position: relative">
                @foreach ($admins as $admin)
                    <div class="d-flex" style="position: relative; padding: 5px 10px;border-bottom: 1px solid black">
                        <div>
                            <strong>{{$admin->username}}</strong>
                            <div>{{$admin->get_role()->name}}</div>
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
