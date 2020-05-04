
$(document).ready(function(){
    var mouse_is_inside = false;
    var startNoti = 0;
    var actionNoti = 'inactive';

    function load_noti(startNoti){
        $.ajax({
            url : origin + "/notification",
            method: "post",
            data: {start:startNoti},
            cache: false,
            success: function(data){
                $('.loader').remove();
                $('.loader2').remove();
                $('#count_noti').remove();
                $('#dropnoti').append(data);
                if(data == ''){
                    $('#dropnoti').append('<a class="text-decoration-none" style="position:absolute;left:40%" href="'+ origin +'/notification">See more</a>')
                    actionNoti = 'active';
                }
                else{
                    actionNoti = 'inactive';
                }
            }
        });
    }
    
    $('#noti').on('click',function(){
        var origin   = window.location.origin;
        $('#dropnoti').toggle();
        $('#dropnoti').html('<div class="loader"></div>');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        load_noti(startNoti);
    });
    
    $('#dropnoti').scroll(function(){
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight && actionNoti == 'inactive') {
            $('#dropnoti').append('<div class="loader2"></div>');
            actionNoti = 'active';
            startNoti = startNoti + 10;
            load_noti(startNoti);
        }
    })
    
    $('#dropnoti').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });
    
    $("body").mouseup(function(){ 
        if(! mouse_is_inside) 
        $('#dropnoti').hide()
        $('.nav-link').removeClass('active')
        startNoti = 0;
        
        ;
    });
});
