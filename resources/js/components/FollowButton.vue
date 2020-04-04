<template>
    <div>
        <button class="btn btn-primary" @click="followUser" v-text="btnText"></button>
    </div>
</template>

<script>
    export default {
        props : [
            'userId',
            'follows'
        ],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return {
                status : this.follows,
            }
        },

        methods : {
            followUser(){
                axios.post('/follow/' + this.userId)
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
                    });
            }
        },

        computed: {
            btnText(){
                return (this.status == true) ? 'Unfollow' : 'Follow';             
            }
        },
    }
</script>

