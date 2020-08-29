import Vue from 'vue'
export const bus = new Vue();
import router from './router';
import Dashboard from './screens/Dashboard';
import Navbar from './components/navbar';
import { store } from './store'
require('./bootstrap');


 const app = new Vue({
    el: '#app',
    components:{
        Dashboard,
        Navbar
    },
    router,
    store
});







