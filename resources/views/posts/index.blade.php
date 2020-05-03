@extends('layouts.app')
@section('content')
<div class="container" style="padding: 2% 10% 0;">
    <div class="row">
        <div class="col-sm-8" id="show_post">
            
        </div>
        <div class="col-sm-4">
            @if (isset($user))
            <div class="info d-flex pt-2 align-items-center">
                @if ($user->profile->url_thumb != '')
                    <a href="{{route('profile.show',$user->id)}}"><img height="50px" width="50px" style="border-radius: 50%" src="/thumbs/{{$user->profile->url_thumb}}" alt=""></a>
                @else
                    <a href="{{route('profile.show',$user->id)}}"><img height="50px" width="50px" style="border-radius: 50%" src="/thumbs/default_ava.jpg" alt=""></a>
                @endif
                <div class="name pl-2">
                    <a class="text-decoration-none text-dark" href="{{route('profile.show',auth()->user()->id)}}"><h5>{{$user->username}}</h5></a>
                    <p class="text-black-50">{{$user->name}}</p>
                </div>
            </div>
            @endif
            <div class="border bg-white" style="height: auto;width: auto">
                <div style="padding: 10px">
                    <div class="d-flex justify-content-between">
                        <span>
                            Suggestions For You
                        </span>
                        <a href="{{route('explore.show')}}">See All</a>
                    </div>
                    <div class="mt-2" >
                        @foreach ($arr_idUser as $userFl)
                            <div class="d-flex">
                                @if ($userFl[0]->url_thumb != '')
                                    <a href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/{{$userFl[0]->url_thumb}}" alt=""></a>
                                @else
                                    <a href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/default_ava.jpg" alt=""></a>
                                @endif
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <a class="text-decoration-none text-dark" href="{{route('profile.show',$userFl[0]->user->id)}}"><strong>{{$userFl[0]->user->username}}</strong></a>
                                        <?php
                                            $follow = DB::table('profile_user')->where([
                                                ['user_id', auth()->user()->id],
                                                ['profile_id', $userFl[0]->id],
                                            ])->get();
                                            $follows = false;
                                            if($follow->count() > 0){
                                                $follows = true;
                                            }
                                        ?>
                                        <follow-button user-id="{{$userFl[0]->user->id}}" follows="{{ $follows}}"></follow-button>
                                    </div>
                                    <div class="d-flex"><span style="font-size: 11px">Friend of {{$userFl[1]}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content content">
            <a class="text-decoration-none" style="font-weight: bold;color: #ed4956;" href=""><div class="in-setting" data-dismiss="modal" data-toggle="modal" data-target="#ModalReportPost">Report Inapproprite</div></a>
            <a data-id="" class="text-decoration-none" id="unfl" style="font-weight: bold;color: #ed4956;cursor: pointer"><div class="in-setting" data-dismiss="modal" data-toggle="modal" data-target="#ModalUnfollow">Unfollow</div></a>
            <a class="text-decoration-none text-dark" id="go_post" href=""><div class="in-setting" style="cursor: pointer">Go to post</div></a>
            <div class="in-setting" style="cursor: pointer">Copy Link</div>
            <div class="in-setting" data-dismiss="modal" aria-label="Close" style="cursor: pointer">Cancel</div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalUnfollow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content content">
            <div class="d-flex justify-content-center align-items-center" style="padding-top:15px">
                <img id="img_in_post" src="" alt="" width="100px" height="100px" style="border-radius: 50%"> 
            </div>
            <div class="d-flex justify-content-center align-items-center in-setting">
                <div>Unfollow <div id="name_in_post"></div></div>
            </div>
            <div class="in-setting" id="unfollow" data-id="" style="cursor: pointer; font-weight: bold;color: #ed4956;">Unfollow</div>
            <div class="in-setting" id="cancel" data-dismiss="modal" aria-label="Close" style="cursor: pointer">Cancel</div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalReportPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content content">
        <div class="modal-header" style="position: relative">
            <h5 class="modal-title" style="position: absolute; left: 35%;font-size: 20px;font-weight: bold" id="exampleModalLabel">Report</h5>
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size: 20px" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="in-setting" style="font-size: 18px;font-weight: 900">Why are you report this post?</div>
            <div id="" data-id="spam" class="in-setting spam" style="cursor: pointer">It's spam</div>
            <div id="" data-id="inapproprite" class="in-setting inapproprite" style="cursor: pointer" data-dismiss="modal" data-toggle="modal" data-target="#ModalWriteReport">It's inapproprite</div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalThankPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content content">
            <div style="padding: 10px">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fas fa-check-circle fa-3x" style="padding: 20px 0;color:rgb(88, 195, 34);d"></i>
                </div>
                <div>
                    <div class="in-setting1" style="font-weight: 900;font-size:16px">Thanks for letting us know</div>
                    <div class="in-setting1" style="color: #8e8e8e; font-size: 14px">Your feedback is important in helping us keep the Instagram community safe.</div>
                </div>
                <button class="btn btn-primary mt-2" style="font-size: 13px;font-weight: 900; width: 100%" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalWriteReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content content">
        <div class="modal-header" style="position: relative">
            <h5 class="modal-title" style="position: absolute; left: 35%;font-size: 15px;font-weight: bold" id="exampleModalLabel">Report a Problem</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size: 20px" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form_report_post" data-id="form" id="" action="{{route('report.create.post')}}" method="POST">
                <div class="form-group">
                    <textarea placeholder="Briefly explain what makes you feel inappropriate." class="form-control" id="content_report" rows="5" required></textarea>
                    <button type="submit" id="btn_send_report" class="btn btn-primary mt-2">Send Report</button>
                </div>
            </form>
            <p style="color: #4c4848; font-weight: 400; font-size: 12px; line-height: 14px; margin: -2px 0 -3px;">Your Instagram username and browser information will be automatically included in your report.</p>
        </div>
        </div>
    </div>
</div>
@endsection