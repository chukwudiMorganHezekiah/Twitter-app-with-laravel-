<template>
    <div v-if="!loading" class="p-2">
        <h2 >Tweets</h2>
        <div>
            <form class="form-horizontal" @submit="handleTweetSubmit" style="position:relative">
                <input type="text" id="tweetBox" v-model="typingTweet"/>
                <input v-if="submitTweet" @click="handleTweetSubmit" style="position:absolute;bottom:0px;right:30px" value="Tweet" type="submit" class="btn btn-primary btn-sm">
            </form><hr />

        </div>
        <div>

            <div v-for="tweet in tweets" :key="tweet.id">
                <SingleTweet :tweet="tweet" />
            </div>
        </div>
    </div>
</template>
<script>
import SingleTweet from './SingleTweet'
export default {
    props:{
        user_id:{
            type:Number,
            required:true
        }
    },
    data(){
        return {
            loading:true,
            typingTweet:'',
            submitTweet:false,
            limit:1,
            tweets:[],
            appending:false

        }
    },
    components:{
        SingleTweet
    },
    watch(){
        function appending(prev, now) {
            console.log(now, prev);
        }

    },
    mounted(){
        let listended = document.getElementById('listended');

        let options = {
            root:null,
            rootMargin:'0px',
            threshold:1.0
        }
        let self = this;
        let callback = (entries, observer)=>{
            entries.forEach(entry => {
                if(entry.target.id == 'listended'){
                    if(entry.isIntersecting){
                        this.appending=true;
                        self.appendedNewTweet()
                        this.appending = false;


                    }

                }

            });

        }
        let observer = new IntersectionObserver(callback, options);
        observer.observe(listended);

        this.get_user_tweets();
    },
    methods:{
         get_user_tweets(){
             var self = this;
             axios.get(`api/get_user_tweets/${this.user_id}/${this.limit}/`).then(function(res){
                 if(res.data){
                     self.tweets = res.data;

                 }
             }).catch(function(err){
                 console.log(err.response.data)
             }).then(function(){
                 self.loading =false;
             })
        },
        appendedNewTweet: function(){
            this.limit ++;
            this.get_user_tweets()

        },
        handleTweetSubmit:function(e){
            e.preventDefault();


            var self = this;
            axios.post('/api/save_new_tweet/',{user_id:self.user_id,tweet:self.typingTweet}).then(function(){

            }).catch(function(err){
                console.log(err.resonse.data)

            }).then(function(){
                self.typingTweet=''
            })
        }

    },
    watch:{
        typingTweet(value,new_value){
            if(value != ''){

                this.submitTweet = true;

            }
        }
    }
}
</script>
<style lang="scss" scoped>
h1{
    color:rgb(255, 255, 255);
}
#tweetBox{
    margin-top: 0px;
    margin-bottom: 0px;
    height: 120px;
    width: 100%;
    padding:40px;
    resize: none;
    background: #f7f7f7;
    border-radius: 70px;

    &:focus{
        border:none;
    }
}
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
