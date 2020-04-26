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
        fetchJobs({ context }, skills) {
            return fetchJobsApi(skills)
        },
        fetchUser({ context }, username) {
            return fetchUserApi(username)
        }
    },
    modules: {

    }
}