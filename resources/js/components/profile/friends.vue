<template>
<div>
    
    <div v-if="loading" class="d-flex" style="justify-content:center">
        <Spinner />
    </div>
    <div v-if="!loading" class="container">
        <h4 class="text-muted text-center">Friends </h4>
        <div class="row">
            
            <div v-for="user in users" :key="user.id" class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <img :src="`/storage/profile_images/${user.profile_image}`" :alt="`profile Image for ${user.profile_name}`" style="border-radius:10px;" class="w-100" />
                <p class="user_name" v-on:click="visitUser(user.id)"> <b>{{ user.profile_name }}</b></p>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Spinner from 'vue-simple-spinner';
export default {
    components:{

    },
    data(){
        return {
            loading:true,
            users :[],
            user_id:null

        }
    },
    components:{
        Spinner 

    },
    mounted(){
        this.user_id = this.$route.params.user_id ;
        this.get_users_followings();
        
    },
    methods:{
        visitUser(id){
            window.location.href=`/edit_profile/${id}`

        },
        get_users_followings(){
            var self = this;
            axios.get(`/api/get_users_followings/${self.user_id}`)
            .then(res=>{
                self.users = res.data;
            })
            .catch(err=>{
                console.log(err.response.data)
            })
            .then(()=>{
                this.loading = false;
            })
        },
        

    }
    
}
</script>

<style scoped>
.user_name:hover{
    cursor:pointer;
    color:blue;


}
</style>