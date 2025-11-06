import axios from 'axios';

const httpClient = axios.create({
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
});

httpClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (process.env.NODE_ENV !== 'production') {
            console.error('API error response', error);
        }
        return Promise.reject(error);
    },
);

export default httpClient;
