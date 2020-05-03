

$(document).ready(function(){
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
});