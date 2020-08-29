import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex)

export const store = new Vuex.Store({
    state:{
        user_id:null
    },
    mutations:{
        set_user_id_commit:function(state,payload){
            state.user_id = payload
        }

    },
    actions:{
        set_user_id:function(context,payload){
            context.commit('set_user_id_commit',payload)
        }
    }


})