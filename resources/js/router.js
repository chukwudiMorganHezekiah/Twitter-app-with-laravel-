import Vue from 'vue' ;
import VueRouter from 'vue-router';
import Home from './components/Home';
import Profile_edit from './components/profile/root';
import ViewTweet from './components/ViewTweet'
Vue.use(VueRouter);

const routes = new  VueRouter({
    mode:'history',
    routes:[
        {
            component:Home,
            path:'/'
        },
        {
            component:Home,
            path:'/home'
        },
        {
            component:ViewTweet,
            path:'/view_tweet/:tweet_id'
        },
        {
            component:Profile_edit,
            path:'/edit_profile/:user_id'
        }
    ]
});

export default routes;
