import axios from 'axios';

const debugActive = false;

const debug = (msg) => {
    if (debugActive) {
        console.error(msg);
    }
}

const fetchUserApi = (username) => {
    debug('fetching user');
    return axios.get(`/api/user/${username}`);
}

export {fetchUserApi}