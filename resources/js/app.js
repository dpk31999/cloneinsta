/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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
  
    var imgc = document.getElementById("myImg");
  
    if(imgc != null){
      imgc.onclick = function(){
        modal.style.display = "block";
      }
    }
  
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