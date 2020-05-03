@foreach ($posts as $post)
<div class="border mb-5 bg-white">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mt-3 info_user" data-user-id="{{$post->user->id}}">
            <a href=" {{route('profile.show' , $post->user->id)}} "><img class="rounded-circle" width="35px" height="35px" src="/thumbs/{{$post->user->profile->url_thumb}}" alt=""></a>
            <a class="pt-2 text-decoration-none text-dark" href=" {{route('profile.show' , $post->user->id)}} "><p class="font-weight-bolder"> {{$post->user->username}} </p></a>
            @if ($post->is_follow() == false)
            <a data-user-id="{{$post->user->id}}" class="text-decoration-none pt-2 follow-in-post" style="color:#b3b3ff;cursor: pointer" id="followInPost">&nbspFollow</a>
            @endif
        </div>
        <div style="padding: 0 10px">
            <i data-post-id="{{$post->id}}" data-image="{{$post->user->profile->url_thumb}}" data-name="{{$post->user->username}}" data-user-id="{{$post->user->id}}" class="fas fa-ellipsis-h open-AddBookDialog" style="font-style: oblique;font-size: 20px; cursor: pointer" data-toggle="modal" data-target="#ModalPost"></i>
        </div>
    </div>
    <img class="w-100 mt-3" src="/storage/{{ $post->image }}" alt="">
    <div style="padding: 10px">
        <div class="icon d-flex">
            <div class="d-flex flex-column">
                @if ($post->is_liked())
                    <button id="like{{$post->id}}" class="btn btn-primary like-post">UnLike</button>
                @else
                    <button id="like{{$post->id}}" class="btn btn-primary like-post">Like</button>
                @endif
                <div><strong id="count_like{{$post->id}}">{{$post->liked->count()}}</strong>Likes</div>
            </div>
        </div>
        {{$post->caption}}
        @if ($post->commented->count() > 2)
            <div>
                <a class="text-decoration-none" href=" {{route('posts.show', $post->id)}} ">View all {{$post->commented->count()}} comments</a>
            </div>
        @endif
        <div id="comments{{$post->id}}">
            @foreach ($post->commented->slice(0,2) as $comment)
                <div class="d-flex bd-highlight mb-2">
                    <div class="p-2 flex-grow-1 bd-highlight"><a class="text-decoration-none text-dark" href="{{route('profile.show',$comment->user->id)}}"><strong>{{$comment->user->username}}</strong></a> {{$comment->content}}</div>
                    @if ($comment->is_liked())
                        <button id="likeCmt{{$comment->id}}" class="btn btn-primary like-comment">UnLike</button>
                    @else 
                        <button id="likeCmt{{$comment->id}}" class="btn btn-primary like-comment">Like</button>
                    @endif
                </div>
            @endforeach
        </div>
        <div style="font-size:12px">{{$post->getTime()}}</div>
    </div>
    <form class="form-comment" data-id="{{$post->id}}" action=" {{route('posts.comment',$post->id)}} " method="post">
        @csrf
        <div class="d-flex" style="position: relative">
            <input class="form-control commentInput" type="text" id="comment" name="comment" placeholder="Add a comment..." style="height: 50px" required>
            <input type="submit" style="position: absolute; right: 10px; top:25px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>
            <div id="request_data"></div>
        </div>
    </form>
</div>
@endforeach