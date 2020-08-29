<template>
    <div>
        <div v-if="loading">
            <Spinner />
        </div>
        <div v-if=!loading>
            <div v-for="profile in profiles" :key="profile.id" class="p-2">
            <div style="display: flex;justify-content: center;">
                <img :src="`/storage/profile_images/${profile.profile_image}`" style="height: 300px; width: 300px;" class="rounded-circle " :alt="`${profile.profile_name} profile_image`" />

            </div>
            <div ><p class="text-muted text-center mt-1">{{ profile.profile_name }} 
                <span v-if="profile.id == localStorage" class="btn btn-primary" style="height: 20px;text-align: center;padding-top:0px;color:white;">Edit</span></p> </div>
            </div>
            

        </div>
    </div>
</template>

<script>
import Spinner from 'vue-simple-spinner'
export default {
    components:{
        Spinner

    },
    data(){
        return {
            user_id:null,
            profiles:[],
            loading:true,
            user_id:null,
            localStorage:null

        }
    },
    mounted(){
        this.user_id = this.$route.params.user_id;
        this.localStorage = parseInt(localStorage.getItem('user_id'))
        if(this.user_id){
            this.get_user_profile();

        }
        
        
        

    },
    
    methods:{
        
        get_user_profile(){
                
                var self = this;
                axios.get(`/api/get_users_profile/${self.user_id}`).then(res =>{
                    console.log(res.data)
                    self.profiles = res.data;
                    self.loading= false;
                }).catch(err =>{

                })


        }
    }
}
</script>
