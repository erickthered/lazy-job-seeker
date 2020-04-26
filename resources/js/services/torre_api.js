import axios from 'axios';

const debugActive = true;

const debug = (msg) => {
    if (debugActive) {
        console.error(msg);
    }
}

const fetchPeopleApi = (criteria) => {
    debug('fetching people');
    return axios.post('/api/people', criteria);
}

const fetchJobsApi = (skills) => {
    debug('fetching jobs');
    return axios.post(`/api/jobs`, skills);
}

const fetchUserApi = (username) => {
    debug('fetching user data');
    return axios.get(`/api/user/${username}`);
}

export { fetchUserApi, fetchJobsApi }