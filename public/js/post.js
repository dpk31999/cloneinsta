/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/post.js":
/*!******************************!*\
  !*** ./resources/js/post.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('.reply').one('click', function () {
    var reply_id = $(this).attr('id');
    var arr = reply_id.split('reply');
    var id = parseInt(arr[0] + arr[1]);
    var set = '#replyComment' + id;
    $(set).removeClass('d-none');
  });
  $('.like-post').on('click', function () {
    var id_post = $(this).attr('id');
    var arr = id_post.split('like');
    var id = parseInt(arr[0] + arr[1]);
    console.log(id);
    console.log($(this).html());
    var count_like = parseInt($('#count_like' + id).html());

    if ($(this).html() == 'UnLike') {
      $(this).html('Like');
      $('#count_like' + id).html(count_like - 1);
    } else {
      $(this).html('UnLike');
      $('#count_like' + id).html(count_like + 1);
    }

    $.ajax({
      type: 'post',
      url: '/like/' + my_id + '/post/' + id,
      data: '',
      cache: false,
      success: function success(data) {}
    });
  });
  $('#like').on('click', function () {
    var id_post = $(this).data('id');
    var count_like = parseInt($('#count_like' + id_post).html());

    if ($(this).html() == 'UnLike') {
      $(this).html('Like');
      $('#count_like' + id_post).html(count_like - 1);
    } else {
      $(this).html('UnLike');
      $('#count_like' + id_post).html(count_like + 1);
    }

    $.ajax({
      type: 'post',
      url: '/like/' + my_id + '/post/' + id_post,
      data: '',
      cache: false,
      success: function success(data) {}
    });
  });
  $('.like-comment').on('click', function () {
    var id_comment = $(this).attr('id');
    var arr = id_comment.split('likeCmt');
    var id = parseInt(arr[0] + arr[1]);
    var count_like = parseInt($('#count_like_cmt' + id).html());

    if ($(this).html() == 'UnLike') {
      $(this).html("Like");
      $('#count_like_cmt' + id).html(count_like - 1);
    } else {
      $(this).html("UnLike");
      $('#count_like_cmt' + id).html(count_like + 1);
    }

    $.ajax({
      type: 'post',
      url: '/like/' + my_id + '/comment/' + id,
      data: '',
      cache: false,
      success: function success(data) {}
    });
  });
  $('.like-comment-post').on('click', function () {
    var id_comment = $(this).data('id');
    var count_like = parseInt($('#count_like_cmt' + id_comment).html());

    if ($(this).html() == 'UnLike') {
      $(this).html("Like");
      $('#count_like_cmt' + id_comment).html(count_like - 1);
    } else {
      $(this).html("UnLike");
      $('#count_like_cmt' + id_comment).html(count_like + 1);
    }

    $.ajax({
      type: 'post',
      url: '/like/' + my_id + '/comment/' + id_comment,
      data: '',
      cache: false,
      success: function success(data) {}
    });
  });
  $('.form-comment').submit(function (e) {
    $form = $(this); //wrap this in jQuery

    var route = $form.attr('action');
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: route,
      data: $(this).serialize(),
      success: function success(data) {
        if (data.comment) {
          $('.commentInput').val('');
        }
      }
    });
  });
  $('.form-comment-post').submit(function (e) {
    $form = $(this); //wrap this in jQuery

    var route = $form.attr('action');
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: route,
      data: $(this).serialize(),
      success: function success(data) {
        if (data.comment) {
          $('.commentInput').val('');
        }
      }
    });
  });
  $('.form-reply-comment').submit(function (e) {
    $form = $(this);
    var route = $form.attr('action');
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: route,
      data: $(this).serialize(),
      success: function success(data) {
        $('.replyInput').val('');
      }
    });
  });
  $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() > $('#show_post').height() && actionPost == 'inactive') {
      $('#show_post').append('<div class="loader2"></div>');
      actionPost = 'active';
      startPost = startPost + 3;
      load_post(startPost);
    }
  });
  $('#show_post').html('<div id="asd">Waiting ...</div>');

  function load_post(startPost) {
    var origin = window.location.origin;
    $post_show = $('#show_post');

    if ($post_show) {
      $.ajax({
        method: 'post',
        url: origin + '/getpost',
        data: {
          start: startPost
        },
        cache: false,
        success: function success(data) {
          $('#save_arr').children('p').each(function () {
            console.log(this.html); // "this" is the current element in the loop
          });

          if (data == '') {
            $('#show_post').append('<div>Het roi :<</div>');
          }

          if ($('#asd')) {
            $('#asd').remove();
          }

          $('.loader2').remove();
          $('#show_post').append(data);
          $('.like-post').on('click', function () {
            var id_post = $(this).attr('id');
            var arr = id_post.split('like');
            var id = parseInt(arr[0] + arr[1]);
            var count_like = parseInt($('#count_like' + id).html());

            if ($(this).html() == 'UnLike') {
              $(this).html("Like");
              $('#count_like' + id).html(count_like - 1);
            } else {
              $(this).html("UnLike");
              $('#count_like' + id).html(count_like + 1);
            }

            $.ajax({
              type: 'post',
              url: '/like/' + my_id + '/post/' + id,
              data: '',
              cache: false,
              success: function success(data) {}
            });
          });
          $('.like-comment').on('click', function () {
            var id_comment = $(this).attr('id');
            var arr = id_comment.split('likeCmt');
            var id = parseInt(arr[0] + arr[1]);
            var count_like = parseInt($('#count_like_cmt' + id).html());

            if ($(this).html() == 'UnLike') {
              $(this).html("Like");
              $('#count_like_cmt' + id).html(count_like - 1);
            } else {
              $(this).html("UnLike");
              $('#count_like_cmt' + id).html(count_like + 1);
            }

            $.ajax({
              type: 'post',
              url: '/like/' + my_id + '/comment/' + id,
              data: '',
              cache: false,
              success: function success(data) {}
            });
          });
          $('.form-comment').submit(function (e) {
            $form = $(this); //wrap this in jQuery

            var route = $form.attr('action');
            e.preventDefault();
            $.ajax({
              type: 'POST',
              url: route,
              data: $(this).serialize(),
              success: function success(data) {
                if (data.comment) {
                  $('.commentInput').val('');
                }
              }
            });
          });

          if (data == '') {
            actionPost = 'active';
          } else {
            actionPost = 'inactive';
          }
        }
      });
    }
  }

  load_post(startPost);
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/post.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\ADMIN\cloneinsta\resources\js\post.js */"./resources/js/post.js");


/***/ })

/******/ });