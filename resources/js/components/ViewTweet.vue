<template>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-2">
                    <div class="row">
                        <div  class="col-lg-6 card p-3">
                            <div v-if="loading" class="d-flex" style="margin-top:10px;justify-content:center"><Spinner /></div>
                            <div v-if="!loading" class="tweets">
                                <div class="d-flex" style="border-bottom: 1px solid rgb(220 220 220);">
                                    <img :src="`/storage/profile_images/${user_profile.profile_image}`" class="rounded-circle profile_image"  :alt="`profile_image for ${user_profile.profile_name}`" />
                                    <p><router-link :to="`/edit_profile/${user.id}`">{{ user_profile.profile_name}}</router-link></p>
                                </div>

                                <div style="" >{{ tweet.tweet }}</div>
                            </div>
                            <div class="comments">
                                <Comments :comments="comments" />
                            </div>
                        </div>
                        <div class="col-lg-4 ml-2 card p-3">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="write_comment_on_tweet"/>
                                </div>
                                <button class="btn btn-primary" style="border-radius: 10px;">Comment</button>

                            </form>
                            <hr />
                        </div>

                    </div>
                </div>
                </div>
        </div>
    </div>

</template>

<script>
import Spinner from 'vue-simple-spinner';
import Comments from './Comments'
export default {
    mounted(){
        this.get_tweet_details();

    },
    components:{
        Comments,
        Spinner
    },
    data(){
        return {
            tweet:[],
            likes:null,
            created_on:null,
            user:[],
            user_profile:[],
            comments:null,
            loading:true,

        }
    },
    methods:{
        get_singele_tweet(){
            axios.get()
            .then()
            .then()
            .catch()
        },
        get_tweet_details(){
            var self = this;
            axios.get(`/api/get_tweet_details/${self.$route.params.tweet_id}`)
            .then(res=>{
                self.tweet = res.data.tweet;
                self.user = res.data.user;
                self.user_profile = res.data.user_profile;
                self.likes =res.data.likes;
                self.created_on= res.data.created_on;
                self.comments= res.data.comments;
                

            })
            .catch(err=>{
                console.log(err.response.data)
            })
            .then(function(){
                self.loading=false
            })

        }

    }

}
</script>

<style scoped>
#content{
    margin-top: 60px;
}
#write_comment_on_tweet{
    width: 100%;
    height: 104px;
    padding: 0px;
    border-radius: 9px;
    box-shadow: 0px 0px 1px #f7f7f7;

}
.tweets {
    height: 117px;
    background: #eaeaea;
    border-radius: 12px;
    padding: 6px;
    margin-top:10px;
 }

 .tweets:hover{
     background: #f7f7f7;
     cursor:pointer;
 }
.profile_image{
    width: 30px;
    height: 30px;
    margin-top: -2px;
    margin-right: 5px;
}
</style>
