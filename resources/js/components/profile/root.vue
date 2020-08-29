<template>
    <div style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 card pb-4">
                    <div><ProfileDetails /></div>
                    <div><Activity /></div>
                    <hr />
                <div>
                    <FriendsList />
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Spinner from 'vue-simple-spinner';
import ProfileDetails from './ProfileDetails';
import Activity from './activity_details';
import FriendsList from './friends'
export default {
    components:{
        Spinner,
        ProfileDetails,
        Activity,
        FriendsList

    },
    data(){
        return {


        }
    },
    mounted(){

    },
    methods:{

    }

}
</script>
<style lang="scss" scoped>

</style>
