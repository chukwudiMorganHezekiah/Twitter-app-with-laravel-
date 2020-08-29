<template>
    <div class="tweets">
        <div class="d-flex p-2" style="height: 41px;border-bottom: 1px solid rgb(208 205 205);;">
            <img :src="`/storage/profile_images/${tweet[0].profile.profile_image}`" class="tweet_profile_image" />
            <h3 style="color: #6f6f6f;font-weight:bold;font-size:15px;margin-top:6px;margin-left:10px;"><router-link :to="`/edit_profile/${tweet[0].profile.user_id}`">{{ tweet[0].profile.profile_name}}</router-link></h3>
        </div>
        <router-link :to="`/view_tweet/${tweet[0].id}`">
            <div class="tweet_content">{{ tweet[0].tweet}}</div>
            <div class="tweet_details d-flex">
                <div>{{ likes }} like(s)  {{ comments }} comment(s)</div>
                <div>{{ created_on }}</div>

            </div>
        </router-link>
    </div>

</template>
<script>
export default {
    props:{
        tweet:{
            type:Array,
            required:true
        }
    },
    data(){
        return {
            likes:null,
            comments:null,
            created_on:null

        }
    },
    mounted(){
        this.get_tweet_details();
    },
    methods:{
        get_tweet_details(){
            var self = this;
            axios.get(`/api/get_tweet_details/${this.tweet[0].id}`)
            .then(res=>{
                self.likes =res.data.likes;
                self.created_on= res.data.created_on;
                self.comments= res.data.comments;

            })
            .catch(err=>{
                console.log(err.response.data)
            })
            .then()

        }
    }

}
</script>
<style  scoped>
.tweet_profile_image {
    width: 30px;
    height: 30px;
    border-radius: 16px;
}
.tweets {
    height: 117px;
    background: #eaeaea;
    border-radius: 12px;
    padding: 2px;
    margin-top:10px;
 }

 .tweets:hover{
     background: #f7f7f7;
     cursor:pointer;
 }
.tweet_content {
    padding: 12px;
    font-size: 17px;
    color: #313030;
}
.tweet_details{
    justify-content: space-between;
    padding-right: 20px;
    padding-left: 20px;
    color: #1b1919;
}

</style>
