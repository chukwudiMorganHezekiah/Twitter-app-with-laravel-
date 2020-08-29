<template>
  <div v-if="!loading">
    <div class="d-flex" style="justify-content:center;margin-top: -20px;">
        <div class="activity">{{ activities.tweet_count }} Tweets</div>
        <div class="activity">{{ activities.followers_count }} Followers</div>
        <div class="activity">{{ activities.following_count }} Followings</div>
        
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
            activities:[],
            loading:true,
            user_id:null

        }
    },
    mounted(){
        this.user_id = this.$route.params.user_id;
        if(this.user_id){
            this.get_user_activity_details();

        }
        

    },
    methods:{
        get_user_activity_details:function(){
            var self = this;
            axios.get(`/api/get_user_activity_details/${self.user_id}`).then(res =>{
                self.activities = res.data;
                self.loading = false

            }).catch(err =>{

            })
        }

    },


}
</script>

<style>
.activity{
    margin-left: 20px;
}
</style>
