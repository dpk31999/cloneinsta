@extends('layouts.app')

@section('content')
<div class="container" style="margin: 5% 30%">
    <span><strong>Suggested</strong></span>
    <div class="mt-3" style="overflow: auto">
        @foreach ($arr_idUser as $userFl)
            <div class="d-flex">
                @if ($userFl[0]->url_thumb != '')
                    <a class="mr-2" href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/{{$userFl[0]->url_thumb}}" alt=""></a>
                @else
                    <a class="mr-2" href="{{route('profile.show',$userFl[0]->user->id)}}"><img height="30px" width="30px" style="border-radius: 50%" src="/thumbs/default_ava.jpg" alt=""></a>
                @endif
                <div style="position: relative;height:65px">
                    <div class="d-flex justify-content-between" style="width: 500px">
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
                    <div style="position: absolute; bottom: 5px">
                        <div><span style="font-size: 11px">{{$userFl[0]->user->name}}</span></div>
                        <div class="d-flex"><span style="font-size: 11px">Friend of {{$userFl[1]}}</span></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection