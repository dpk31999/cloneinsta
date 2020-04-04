@extends('layouts.app')

@section('content')
<div class="container pt-5" style="padding: 0 9%">
    <div class="row">
        <div class="col-3">
            <div class="list-group">
            <a href=" {{ route('profile.edit') }}  " class="list-group-item list-group-item-action {{ (request()->is('accounts/edit')) ? 'active' : '' }} ">
                Edit Profile
            </a>
            <a href=" {{route('profile.editpass')}} " class="list-group-item list-group-item-action {{ (request()->is('accounts/password/change')) ? 'active' : '' }} ">
                Change Password
            </a>
            </div>
        </div>
        <div class="col-9">
            @yield('contentedit')
        </div>
    </div>
</div>
@endsection