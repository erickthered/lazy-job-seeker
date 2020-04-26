import axios from 'axios';

const debugActive = true;

const fetchPeopleApi = (criteria) => {
    return axios.post('/api/people', criteria);
}

const fetchJobsApi = (skills) => {
    return axios.post(`/api/jobs`, skills);
}

const fetchUserApi = (username) => {
    return axios.get(`/api/user/${username}`);
}

export { fetchUserApi, fetchJobsApi }