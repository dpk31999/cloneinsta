@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>date create</th>
                                <th>username</th>
                                <th>name</th>
                                <th>email</th>
                                <th>status</th>
                                <th>provider</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($users as $user)
                                <tr class="user" style="<?php if($user->status == 1) echo 'background-color: #ffb3b3' ?>" data-id="{{$user->id}}">
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if ($user->status == 0)
                                    <td id="status{{$user->id}}">Active</td>
                                    @else
                                    <td id="status{{$user->id}}"">Block</td>
                                    @endif
                                    <td>{{$user->provider}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
    <a class="dropdown-item block" data-id="block" style="cursor: pointer" id="">Block/Unblock</a>
    <a class="dropdown-item view" data-id="view" style="cursor: pointer" id="" >View Detail</a>
</div>

<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">User Management</div>
                    <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body" style="margin: 0 10px">
                    <div class="card-title">
                        <h3 class="text-center title-2">View Detail</h3>
                    </div>
                    <hr>
                    <div class="mb-2"><strong>Account</strong></div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Name</p>
                        <p style="position: absolute;right: 0px" id="name"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>User Name</p>
                        <p style="position: absolute;right: 0px" id="username"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Email</p>
                        <p style="position: absolute;right: 0px" id="email"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Provider</p>
                        <p style="position: absolute;right: 0px" id="provider"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Status</p>
                        <p style="position: absolute;right: 0px" id="status"></p>
                    </div>
                    <div class="mb-2 mt-2"><strong>Other Infomation</strong></div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Posts</p>
                        <p style="position: absolute;right: 0px" id="posts"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Followings</p>
                        <p style="position: absolute;right: 0px" id="following"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Followers</p>
                        <p style="position: absolute;right: 0px" id="follower"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection