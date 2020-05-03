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
                                <th>Date create</th>
                                <th>User create</th>
                                <th>Likes</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Reports</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="post" data-id="{{$post->id}}">
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->user->username}}</td>
                                    <td>{{$post->liked->count()}}</td>
                                    <td>{{$post->commented->count()}}</td>
                                    @if ($post->status == 0)
                                    <td>Active</td>
                                    @else
                                    <td>Block</td>
                                    @endif
                                    <td>{{$post->reportedPost->count()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection