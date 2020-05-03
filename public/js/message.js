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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/message.js":
/*!*********************************!*\
  !*** ./resources/js/message.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.onload = function () {
  $('.user').click(function () {
    // $('#messages').html('<div class="loader"></div>');
    $('.user').removeClass('active');
    $(this).addClass('active');
    receiver_id = $(this).attr('id');
    $.ajax({
      type: "get",
      url: "message/" + receiver_id,
      // need to create this route
      data: "",
      cache: false,
      success: function success(data) {
        $('#pen' + receiver_id).remove();
        var count_mess = parseInt($('#count_mess').html());

        if (count_mess) {
          if (count_mess == 1) {
            $('#count_mess').remove();
          } else {
            $('#count_mess').html(count_mess - 1);
          }
        }

        var countM = parseInt($('#countM').html());

        if (countM) {
          if (countM == 1) {
            $('#parent_m').remove();
          } else {
            $('#countM').html(countM - 1);
          }
        }

        $('#messages').html(data);
        scrollToBottomFunc();
      }
    });
  });
  $('#mess_request').on('click', function () {
    $('.user-wrapper').html('<div class="loader1"></div>');
    $('.item').removeClass('bg-info');
    $(this).addClass('bg-info');
    $.ajax({
      method: 'post',
      url: 'request',
      data: "",
      cache: false,
      success: function success(data) {
        $('.user-wrapper').html(data);
        $('.user').click(function () {
          // $('#messages').html('<div class="loader"></div>');
          $('.user').removeClass('active');
          $(this).addClass('active');
          receiver_id = $(this).attr('id');
          $.ajax({
            type: "get",
            url: "message/" + receiver_id,
            // need to create this route
            data: "",
            cache: false,
            success: function success(data) {
              $('#pen' + receiver_id).remove();
              var count_mess = parseInt($('#count_mess').html());

              if (count_mess) {
                if (count_mess == 1) {
                  $('#count_mess').remove();
                } else {
                  $('#count_mess').html(count_mess - 1);
                }
              }

              if (countR) {
                if (countR == 1) {
                  $('#parent_r').remove();
                } else {
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
  $('#mess_reccent').on('click', function () {
    $('.user-wrapper').html('<div class="loader1"></div>');
    $('.item').removeClass('bg-info');
    $(this).addClass('bg-info');
    $.ajax({
      method: 'post',
      url: 'reccent',
      data: "",
      cache: false,
      success: function success(data) {
        $('.user-wrapper').html(data);
        $('.user').click(function () {
          // $('#messages').html('<div class="loader"></div>');
          $('.user').removeClass('active');
          $(this).addClass('active');
          receiver_id = $(this).attr('id');
          $.ajax({
            type: "get",
            url: "message/" + receiver_id,
            // need to create this route
            data: "",
            cache: false,
            success: function success(data) {
              $('#pen' + receiver_id).remove();
              var count_mess = parseInt($('#count_mess').html());

              if (count_mess) {
                if (count_mess == 1) {
                  $('#count_mess').remove();
                } else {
                  $('#count_mess').html(count_mess - 1);
                }
              }

              var countM = parseInt($('#countM').html());

              if (countM) {
                if (countM == 1) {
                  $('#parent_m').remove();
                } else {
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
    var message = $(this).val(); // check if enter key is pressed and message is not null also receiver is selected

    if (e.keyCode == 13 && message != '' && receiver_id != '') {
      $(this).val(''); // while pressed enter text box will be empty

      var datastr = "receiver_id=" + receiver_id + "&message=" + message;
      $.ajax({
        type: "post",
        url: "message",
        // need to create this post route
        data: datastr,
        cache: false,
        success: function success(data) {},
        error: function error(jqXHR, status, err) {},
        complete: function complete() {
          scrollToBottomFunc();
        }
      });
    }
  });

  function scrollToBottomFunc() {
    $('.message-wrapper').animate({
      scrollTop: $('.message-wrapper').get(0).scrollHeight
    }, 50);
  }
};

/***/ }),

/***/ 3:
/*!***************************************!*\
  !*** multi ./resources/js/message.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\ADMIN\cloneinsta\resources\js\message.js */"./resources/js/message.js");


/***/ })

/******/ });