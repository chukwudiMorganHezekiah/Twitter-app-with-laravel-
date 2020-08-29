<template>
    <div class="p-3">

        <div v-if="!loading">
            <div class="d-flex"><img src="/assets/icon.jpg" class="mt-1 mr-1"  style="width:30px;height:30px" alt="twitter_icon"><h2>Ready Tweet</h2></div>
            <div class="details-box ">
                <h2 id="profile">Profile</h2>
                <div class="d-flex ">
                    <div><img :src=" `/storage/profile_images/${user_profile_image}`" style="width:80px;height:80px;" class=" rounded-circle" alt="user_profile_image"></div>
                    <div class="username mt-4 ml-2">{{ user_name }}</div>
                </div>
                <div class="d-flex " style="justify-content:space-between;">
                    <div>
                        <p>Followers</p>
                        <h3 class="follow_details">{{ followed }}</h3>
                     </div>
                    <div>
                        <p>Following</p>
                        <h3 class="follow_details">{{ following }}</h3>
                     </div>
                </div>

                <div class="d-flex">
                    <button><router-link :to="`/edit_profile/${user_id}`" style="color:white">Edit</router-link></button>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
import { bus } from '../app';
    export default {
        name:'sidebar1',
        props:{
            user_id:{
                type:Number,
                required:true,
            }
        },
        mounted() {
            this.get_user_profile_image();
            var self = this;
            bus.$on('follow_button_click', function(data){
                
                self.get_user_profile_image();
            })

        },
        data(){
            return {
                user_profile_image:null,
                user_name:null,
                loading:true,
                following:null,
                followed:null
            }

        },
        methods:{
            get_user_profile_image(){
                var self = this;
                axios.get(`api/get_user_profile_image/${localStorage.getItem('user_id')}`).then(function(res){
                    self.user_profile_image = res.data.profile_image;
                    self.user_name = res.data.username
                    self.loading = false;
                    self.following =res.data.following;
                    self.followed= res.data.followed;
                }).catch(function(err){
                    console.log(err.response.data)

                })

            }
        }
    }
</script>
<style lang="scss" scoped>
h2{
    color:grey;
}
.details-box{
    background:#eaeaea;
    height: 290px;
    border-radius: 30px;
    padding: 10px;
}
h2#profile{
    color:white;
}
button{
    background:#4daef3;;
    color: white;
    padding: 7px;
    border-radius: 30px;
    border: none;
    text-align: center;
    width: 300px;
}
.follow_details{
    color:white;
    margin-top:-20px
}
</style>
