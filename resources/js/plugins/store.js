import Vue from 'vue';
import Vuex from 'vuex';
import { fetchUserApi } from '../services/torre_api';

Vue.use(Vuex);

export default {
    state: {

    },
    mutations: {

    },
    actions: {
        fetchUser({ context }, username) {
            console.log('gets here');
            return fetchUserApi(username);
        }
    },
    modules: {

    }
}