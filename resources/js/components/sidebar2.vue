<template>
    <div class="">
        <div v-if="loading"> <Spinner /> </div>
     <div v-if="!loading" id="like-box" class="p-3">
         <h4 style="color:grey">People You may like </h4>
         <div v-if="no_user"> Sorry,no user yet...</div>
         <div v-if="!no_user">
            <div v-for=" user in users" :key ="user.id" >
                <div class="d-flex" style="text-align:center">
                    <div><img :src="`/storage/profile_images/${user.profile.profile_image}`" class="profile_image"></div>
                    <p clas="mt-2" style="margin-top:10px"><router-link :to="`/edit_profile/${user.id}`">{{ user.name}}</router-link></p>
                    <button @click="handleFollows(user.id,`follow_button${user.id}`)" :id="`follow_button${user.id}`" class="btn btn-primary btn-sm follow-button ml-1">Follow</button>
                </div>
                <hr />
            </div>
        </div>

     </div>

    </div>
</template>

<script>
import Spinner from 'vue-simple-spinner';
import { bus } from '../app';
    export default {

        name:'sidebar2',
        components:{
            Spinner,
        },
        props:{
            user_id:{
                type:Number,
                required:true,
            }
        },
        mounted() {
            this.get_other_users();
        },
        data(){
            return {
                loading:true,
                users:[],
                no_user :false

            }
        },
        methods:{
            get_other_users(){
                var self = this;
                axios.get(`/api/get_other_users/${self.user_id}`).then(function(res){

                    if(res.data.length > 0){
                        self.users =res.data
                        self.loading = false

                    }else{
                        self.loading = false;
                        self.no_user = true;
                    }




                }).catch(function(err){
                    console.log(err.response.data)
                })
            },
            handleFollows(user_id,ref_id){
                var self = this;
                axios.post('api/follow_user',{follower_id:self.user_id,following_id:user_id}).then(function (res){
                    bus.$emit('follow_button_click','clcik')
                    if(res.data.attached[0]){
                        document.getElementById(ref_id).innerHTML='Unfollow';

                    }else{
                        document.getElementById(ref_id).innerHTML='Follow';
                    }




                }).catch(err=>{
                    console.log(err)
                })

            }
        }
    }
</script>
<style lang="scss" scoped>
#like-box{
    text-align:center;
}
.profile_image{
    width: 30px;
    height: 30px;
    border-radius: 20px;
    margin-top: 5px;
    margin-right: 4px;
}
.follow-button {
    height: 25px;
    background: #4daef3;
    border: none;
    border-radius: 30px;
    margin-top: 5px;
}
</style>
