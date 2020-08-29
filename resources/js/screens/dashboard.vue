<template>
    <div>
        <Navbar />
        <router-view>
        </router-view>
    </div>
</template>
<script>
import Navbar from '../components/navbar'
export default {

    mounted(){
        console.log("mounted now")
    },
    components:{
        Navbar
    }
}
</script>
