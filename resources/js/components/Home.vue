<template>
    <div>
      <div class="container">
      <div v-if="loading" id="loader"><Spinner /></div>
        <div v-if="!loading" class="cover-div">
                <div class="sidebar1 boxs">
                    <sidebar1 :user_id ="user_id"  />
                </div>


                <div class="main-content boxs" >
                    <MainContent :user_id ="user_id" />
                </div>



                <div class="sidebar2 boxs" >
                    <sidebar2 :user_id ="user_id" />
                </div>

        </div>
    </div>
</div>

</template>
<script>
import sidebar1 from './sidebar1';
import sidebar2 from './sidebar2';
import Spinner from 'vue-simple-spinner';
import MainContent from './Maincontent';
export default {
     mounted(){
         this.get_user_auths();
        console.log(Spinner)

    },
    methods:{
         get_user_auths(){
            var self = this;
         axios.get('/get_auth_user/').then(res=>{
             self.user_id = res.data.user_id;
             self.loading = false;
             localStorage.setItem('user_id',self.user_id)

        }).catch(err=>{

        })

        }

    },
    data(){
        return {
            user_id:null,
            loading:true

        }
    },
    components:{
        Spinner,
        sidebar1,
        sidebar2,
        MainContent
    }
}
</script>
 <style lang="scss" scoped>
 .cover-div{
     display: flex;
     flex-direction: row;
 }
 .boxs{
     background:white;
 }
 .sidebar1,.main-content{
     border-right:1px solid #eaeaea;
 }
 .main-content{
     width: 58.5%;
     margin-left: 230px;
     margin-top: 61px;
     margin-bottom: 30px;
     padding-bottom: 20px;
 }


 .sidebar1,.sidebar2{
     width:20%;
     height:80vh;
     position:fixed;
     z-index: 1;
     top:60px;
     overflow-x:hidden;
     padding-top:10px;
     overflow-y:hidden;

 }
 .sidebar1{
     left:80px;

 }
 .sidebar2{
     right:80px;

 }
 #loader{
     margin-top: 100px;
     left: 50%;
     position: absolute;
     top: 43px;
     z-index: 14;
 }

 </style>
