import Vue from 'vue';
import Vuex from 'vuex';
import { fetchUserApi } from '../services/torre_api';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        skills: []
    },
    getters: {
        getSkills(state) {
            return state.skills.map( skill => {return skill.name});
        }
    },
    mutations: {
        removeAllSkills(state) {
            state.skills = [];
        },
        addSkill(state, skill) {
            state.skills.push(skill);
        },
        removeSkill(state, idx) {
            state.skills.splice(idx, 1);
        }
    },
    actions: {
        clearSkills(context) {
            context.commit('removeAllSkills');
        },
        addSkill(context, skill) {
            context.commit('addSkill', skill);
        },
        removeSkill(context, idx) {
            context.commit('removeSkill', idx);
        },
        fetchJobs(context, skills) {
            return fetchJobsApi(skills)
        },
        fetchUser(context, username) {
            return fetchUserApi(username)
        }
    }
});