window.onload = function(){
    $('.user').click(function () {
        // $('#messages').html('<div class="loader"></div>');
        $('.user').removeClass('active');
        $(this).addClass('active');

        receiver_id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "message/" + receiver_id, // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                $('#pen'+ receiver_id).remove();
                var count_mess = parseInt($('#count_mess').html());
                if(count_mess){
                    if(count_mess == 1){
                        $('#count_mess').remove();
                    }
                    else{
                        $('#count_mess').html(count_mess - 1);
                    }
                }
                var countM = parseInt($('#countM').html());
                if(countM){
                    if(countM == 1){
                        $('#parent_m').remove();
                    }
                    else{
                        $('#countM').html(countM - 1);
                    }
                }
                $('#messages').html(data);
                scrollToBottomFunc();
            }
        });
    });

    $('#mess_request').on('click',function(){
        $('.user-wrapper').html('<div class="loader1"></div>');
        $('.item').removeClass('bg-info');
        $(this).addClass('bg-info');
        $.ajax({
            method: 'post',
            url : 'request',
            data: "",
            cache: false,
            success: function(data){
                $('.user-wrapper').html(data);
                $('.user').click(function () {
                    // $('#messages').html('<div class="loader"></div>');
                    $('.user').removeClass('active');
                    $(this).addClass('active');

                    receiver_id = $(this).attr('id');
                    $.ajax({
                        type: "get",
                        url: "message/" + receiver_id, // need to create this route
                        data: "",
                        cache: false,
                        success: function (data) {
                            $('#pen'+ receiver_id).remove();
                            var count_mess = parseInt($('#count_mess').html());
                            if(count_mess){
                                if(count_mess == 1){
                                    $('#count_mess').remove();
                                }
                                else{
                                    $('#count_mess').html(count_mess - 1);
                                }
                            }
                            if(countR){
                                if(countR == 1){
                                    $('#parent_r').remove();
                                }
                                else{
                                    $('#countR').html(countR - 1);
                                }
                            }
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                });
            }
        });
    });

    $('#mess_reccent').on('click',function(){
        $('.user-wrapper').html('<div class="loader1"></div>');
        $('.item').removeClass('bg-info');
        $(this).addClass('bg-info');
        $.ajax({
            method: 'post',
            url : 'reccent',
            data: "",
            cache: false,
            success: function(data){
                $('.user-wrapper').html(data);
                $('.user').click(function () {
                    // $('#messages').html('<div class="loader"></div>');
                    $('.user').removeClass('active');
                    $(this).addClass('active');

                    receiver_id = $(this).attr('id');
                    $.ajax({
                        type: "get",
                        url: "message/" + receiver_id, // need to create this route
                        data: "",
                        cache: false,
                        success: function (data) {
                            $('#pen'+ receiver_id).remove();
                            var count_mess = parseInt($('#count_mess').html());
                            if(count_mess){
                                if(count_mess == 1){
                                    $('#count_mess').remove();
                                }
                                else{
                                    $('#count_mess').html(count_mess - 1);
                                }
                            }
                            var countM = parseInt($('#countM').html());
                            if(countM){
                                if(countM == 1){
                                    $('#parent_m').remove();
                                }
                                else{
                                    $('#countM').html(countM - 1);
                                }
                            }
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                });
            }
        });
    });
    
    $(document).on('keyup', '.input-text input', function (e) {
        var message = $(this).val();

        // check if enter key is pressed and message is not null also receiver is selected
        if (e.keyCode == 13 && message != '' && receiver_id != '') {
            $(this).val(''); // while pressed enter text box will be empty

            var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            $.ajax({
                type: "post",
                url: "message", // need to create this post route
                data: datastr,
                cache: false,
                success: function (data) {

                },
                error: function (jqXHR, status, err) {
                },
                complete: function () {
                    scrollToBottomFunc();
                }
            })
        }
    });

    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
}