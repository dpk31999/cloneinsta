<template>
    <div class="d-flex" style="position: relative;">
        <div><button id="like" class="btn btn-primary" @click="likeUser()" v-text="btnText"></button></div>
        <div style="position: absolute; left: 70px;bottom:5px" class="p-2 bd-highlight d-flex"><strong v-text="countLike"> </strong> Likes</div>
    </div>
</template>

<script>
export default {
    props: [
      'userId',
      'commentId',
      'likes',
      'countlike'
    ],

    data: function(){
            return {
                status : this.likes,
                count : this.countlike
            }
        },

    mounted() {
            console.log('Component mounted.')
    },
    methods : {
        likeUser(){
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post('/like/' + this.userId + '/comment/' + this.commentId)
                .then(response => {
                    if(typeof this.status == 'string'){
                            if(this.status == 1){
                                this.status = true;
                            }
                            else{
                                this.status = false;
                            }
                        }   
                    this.status =  !this.status;
                   if(this.status == true){
                       this.count++;
                   }
                   else{
                       this.count--;
                   }
                });
        }
    },

    computed: {
        btnText(){
            return (this.status == true) ? 'Unlike' : 'Like';             
        },
        countLike(){
            return this.count;
        }
    },
}
</script>

<style>

</style>