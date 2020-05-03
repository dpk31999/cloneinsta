
$(document).ready(function(){
    $('.reply').one('click',function(){
        var reply_id = $(this).attr('id');
        var arr = reply_id.split('reply');
        var id = parseInt(arr[0]+arr[1]);
        var set = '#replyComment' + id;
        $(set).removeClass('d-none');
    });
    
    $('.like-post').on('click',function(){
        var id_post = $(this).attr('id');
        var arr = id_post.split('like');
        var id = parseInt(arr[0]+arr[1]);
        console.log(id);
        console.log($(this).html());
        var count_like =  parseInt($('#count_like'+ id).html());   
        if($(this).html() == 'UnLike'){
            $(this).html('Like');
            $('#count_like'+ id).html(count_like -1);
        }
        else{
            $(this).html('UnLike');
            $('#count_like'+ id).html(count_like + 1);
        }
    
        $.ajax({
            type: 'post',
            url: '/like/' + my_id + '/post/' + id,
            data: '',
            cache: false,
            success: function(data){
    
            }
        });
    });

    $('#like').on('click',function(){
        var id_post = $(this).data('id');
        var count_like =  parseInt($('#count_like'+ id_post).html());   
        if($(this).html() == 'UnLike'){
            $(this).html('Like');
            $('#count_like'+ id_post).html(count_like -1);
        }
        else{
            $(this).html('UnLike');
            $('#count_like'+ id_post).html(count_like + 1);
        }
    
        $.ajax({
            type: 'post',
            url: '/like/' + my_id + '/post/' + id_post,
            data: '',
            cache: false,
            success: function(data){
    
            }
        });
    });
    
    $('.like-comment').on('click',function(){
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
    
    $('.like-comment-post').on('click',function(){
        var id_comment = $(this).data('id');
        var count_like =  parseInt($('#count_like_cmt'+ id_comment).html());
        if($(this).html() == 'UnLike'){
            $(this).html("Like");
            $('#count_like_cmt'+ id_comment).html(count_like -1);
        }
        else{
            $(this).html("UnLike");
            $('#count_like_cmt'+ id_comment).html(count_like + 1);
        }
    
        $.ajax({
            type: 'post',
            url: '/like/' + my_id + '/comment/' + id_comment,
            data: '',
            cache: false,
            success: function(data){
    
            }
        });
    });

    $('.form-comment').submit(function(e){
        $form = $(this); //wrap this in jQuery
        var route = $form.attr('action');
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: route,
            data: $(this).serialize(),
            success: function(data){
                if(data.comment){
                    $('.commentInput').val('');
                }
            }
        });
    });
    
    $('.form-comment-post').submit(function(e){
        $form = $(this); //wrap this in jQuery
        var route = $form.attr('action');
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: route,
            data: $(this).serialize(),
            success: function(data){
                if(data.comment){
                    $('.commentInput').val('');
                }
            }
        });
    });
    
    
    
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
    
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $('#show_post').height() && actionPost == 'inactive'){
            $('#show_post').append('<div class="loader2"></div>');
            actionPost = 'active';
            startPost = startPost + 3;
            load_post(startPost);
        } 
    });
    
    $('#show_post').html('<div id="asd">Waiting ...</div>')
    
    function load_post(startPost){
        var origin   = window.location.origin;
        $post_show = $('#show_post');
        if($post_show){
            $.ajax({
                method: 'post',
                url: origin + '/getpost',
                data: {start:startPost},
                cache: false,
                success: function(data){
                    $('#save_arr').children('p').each(function () {
                        console.log(this.html); // "this" is the current element in the loop
                    });
                    if(data == ''){
                        $('#show_post').append('<div>Het roi :<</div>');
                    }
                    if($('#asd')){
                        $('#asd').remove();
                    }
                    $('.loader2').remove();
                    $('#show_post').append(data);
                    $('.like-post').on('click',function(){
                        var id_post = $(this).attr('id');
                        var arr = id_post.split('like');
                        var id = parseInt(arr[0]+arr[1]);
                        var count_like =  parseInt($('#count_like'+ id).html());   
                        if($(this).html() == 'UnLike'){
                            $(this).html("Like");
                            $('#count_like'+ id).html(count_like -1);
                        }
                        else{
                            $(this).html("UnLike");
                            $('#count_like'+ id).html(count_like + 1);
                        }
                    
                        $.ajax({
                            type: 'post',
                            url: '/like/' + my_id + '/post/' + id,
                            data: '',
                            cache: false,
                            success: function(data){
                    
                            }
                        });
                    });
                    
                    $('.like-comment').on('click',function(){
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
                    
                    $('.form-comment').submit(function(e){
                        $form = $(this); //wrap this in jQuery
                        var route = $form.attr('action');
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: route,
                            data: $(this).serialize(),
                            success: function(data){
                                if(data.comment){
                                    $('.commentInput').val('');
                                }
                            }
                        });
                    });
                    if(data == ''){
                        actionPost = 'active';
                    }
                    else{
                        actionPost = 'inactive';
                    }
                }
            });
        }
    }
    
    load_post(startPost);
});

