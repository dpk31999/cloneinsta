/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery/dist/jquery');
require('jquery-pjax/jquery.pjax');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('follow-button', require('./components/FollowButton.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);
Vue.component('like-comment', require('./components/LikeComment.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

window.onload = function(){ 
    

    var modal = document.getElementById("myModal");
  
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
        window.history.back();
      }
    }

    var imageSources = ["anh1.jpg", "anh2.jpg", "anh3.jpg", "anh4.jpg", "anh5.jpg"];
    var index = 0;
    var img123 = document.getElementById("imageChange"); 
    if(img123 !== null){
      setInterval (function(){ 
        if (index === imageSources.length) {
          index = 0;
        }
        img123.src = "image/" + imageSources[index];
        index++;
      } , 4000);
    }
};

$(document).ready(function(){
  
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  // $(document).pjax('a', '#body');
  // if ($.support.pjax) {
  //     $.pjax.defaults.timeout = 12000; // time in milliseconds
  // }
  var origin = window.location.origin;

  if(window.location.pathname == ''){
    startPost = 0;
    actionPost = 'inactive';
  }

  // $('#save_arr > p').each(function () {
  //     console.log(this.value);
  //     console.log(1);
  // });

  $('#form_report').on('submit',function(e){
      e.preventDefault();
      $('#btn_send_report').html('Waiting...');
      var origin   = window.location.origin;
      var content_report =  $('#content_report').val();
      $.ajax({
          method: 'post',
          url: origin + '/report',
          data: {content_report:content_report},
          cache: false,
          success: function(data){
              $('#content_report').val('');
              $('#btn_send_report').html('Send Report');
              $('#btn_send_report').attr('data-dismiss', 'modal');
              $('#btn_send_report').attr('data-toggle', 'modal');
              $('#btn_send_report').attr('data-target', '#ModalThank');
              document.getElementById('btn_send_report').click();
              $('#btn_send_report').removeAttr("data-dismiss");    
              $('#btn_send_report').removeAttr("data-toggle");
              $('#btn_send_report').removeAttr("data-target");
          }
      });
  });

  $(document).on("click", ".open-AddBookDialog", function () {
      var origin   = window.location.origin;
      var post_id = $(this).data('post-id');
      var image = $(this).data('image');
      var name = $(this).data('name');
      var user_id = $(this).data('user-id');
      $(".content").find('a[id="go_post"]').attr('href',origin + '/p/' + post_id);
      $(".content").find('img[id="img_in_post"]').attr('src',origin + '/thumbs/' + image);
      $(".content").find('div[id="name_in_post"]').html('@' + name + '?');
      $(".modal-body").find('div[data-id="spam"]').attr('id', 'spam' + post_id);
      $(".content").find('div[id="unfollow"]').attr('data-id',user_id);
      $(".modal-body").find('div[data-id="inapproprite"]').attr('id','inapproprite' + post_id);
      $(".modal-body").find('form[data-id="form"]').attr('id',  'report' + post_id);
      $(".content").find('a[id="unfl"]').attr('data-id', user_id);

      if(arr.includes(user_id)){
          $('#unfl').hide();
      }
      else{
          $('#unfl').show();
      }
  });

  $('#unfollow').on('click',function(){
      var user_id = $(this).data('id');
      $.ajax({
          method: 'post',
          url: '/follow/' + user_id,
          data: '',
          cache: false,
          success: function(data){
              document.getElementById('cancel').click();
              $('#unfl').hide();
              arr.push(user_id);
              $(".d-flex").find('div[data-user-id="'+ user_id +'"]').append('<a data-user-id="'+ user_id +'" class="text-decoration-none pt-2 follow-in-post" style="color:#b3b3ff;cursor: pointer" id="followInPost">&nbspFollow</a>')
              $('.follow-in-post').on('click',function(){
                  var user_id = $(this).data('user-id');
                  arr.splice(arr.indexOf(user_id),1);
                  $.ajax({
                      method: 'post',
                      url: '/follow/' + user_id,
                      data: '',
                      cache: false,
                      success: function(data){
                          $('#unfl').show();
                          $('.follow-in-post').remove();
                      }
                  });
              });
          }
      });
  });

  $('.spam').on('click',function(){
      var origin   = window.location.origin;
      var id = $(this).attr('id');
      var arr = id.split('spam');
      var post_id = parseInt(arr[0]+arr[1]);
      var type = $(this).html();
      var content_report = '';
      $.ajax({
          method: 'post',
          url: origin + '/reportPost',
          data: {post_id:post_id,type:type,content_report:content_report},
          cache: false,
          success: function(data){
              $('#close').attr('data-toggle', 'modal');
              $('#close').attr('data-target', '#ModalThankPost');
              document.getElementById('close').click();
              $('#close').removeAttr("data-toggle");
              $('#close').removeAttr("data-target");
          }
      });
  });

  $('.form_report_post').on('submit',function(e){
      e.preventDefault();
      $('#btn_send_report').html('Waiting...');
      var origin   = window.location.origin;
      var id = $(this).attr('id');
      console.log(id);
      var arr = id.split('report');
      var post_id = parseInt(arr[0]+arr[1]);
      
      var type = "It's inapproprite";
      var content_report = $('#content_report').val();
      $.ajax({
          method: 'post',
          url: origin + '/reportPost',
          data: {post_id:post_id,type:type,content_report:content_report},
          cache: false,
          success: function(data){
              $('#content_report').val('');
              $('#btn_send_report').html('Send Report');
              $('#btn_send_report').attr('data-dismiss', 'modal');
              $('#btn_send_report').attr('data-toggle', 'modal');
              $('#btn_send_report').attr('data-target', '#ModalThankPost');
              document.getElementById('btn_send_report').click();
              $('#btn_send_report').removeAttr("data-dismiss");    
              $('#btn_send_report').removeAttr("data-toggle");
              $('#btn_send_report').removeAttr("data-target");
          }
      });
  });
});