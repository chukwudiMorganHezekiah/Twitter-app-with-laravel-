<template>
    <div>
        <div class="navbar">
            <div class="brand">
                <a href="/">Twitter</a>
            </div>
            <div class="links">
                <div class="links" v-if="!loggedin">
                    <a href="/login">Login</a>
                    <a href="/register">SignUp</a>
                </div>
                <div class="links" v-if="loggedin">
                    <a href="/logout" @click.prevent="logout">Logout</a>
                </div>

            </div>

         </div>

         <form action="/logout" method="post" ref="logout" id="logout">
         </form>
    </div>
</template>

<script>
import { bus } from '../app';

export default {
    mounted(){
        this.getIfUserIsLoggedIn()
    },
    data(){
        return {
            loggedin:false,
        }
    },
    methods:{
        getIfUserIsLoggedIn(){
            var self = this;
            axios.get('/verify_user_logged_in').then(function(res){
                console.log(res.data)
                if(res.data == null){
                    self.loggedin = false;
                }else{
                    self.loggedin =true;
                }
            }).catch(function(err){
                console.log(err.response.data)
            }).then(function(){
                bus.$emit('user_not_logged_in','loaded')
            })

        },
        logout(){
            this.$refs.logout.submit()

        }

    }

}
</script>
<style lang="scss" scoped>
.navbar{
    width: 100%;
    background: white;
    border-bottom: 1px solid;
    box-shadow: 2px solid;
    padding: 10px;
    padding-right:100px;
    padding-left:100px;
    display: flex;
    margin-bottom:10px;
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    z-index: 10;
    .brand{
        a{
            font-size: 20px;
        }
    }
    .links{
        display:flex;
        a{
            margin-left:20px;
        }

    }
}

</style>
