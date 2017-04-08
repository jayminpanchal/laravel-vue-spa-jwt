import axios from 'axios';
import {store} from '../store';

axios.interceptors.request.use(
    config => {
        if (store.getters.authToken) {
            config.headers.common['Authorization'] = `Bearer ${store.getters.authToken}`
        }

        return config
    },
    error => Promise.reject(error)
);