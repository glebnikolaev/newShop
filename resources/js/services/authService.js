import http from './httpClient';

export async function login(credentials) {
    await http.get('/sanctum/csrf-cookie');
    const { data } = await http.post('/api/v1/login', credentials);
    return data;
}

export async function register(payload) {
    await http.get('/sanctum/csrf-cookie');
    const { data } = await http.post('/api/v1/register', payload);
    return data;
}

export async function logout() {
    await http.get('/sanctum/csrf-cookie');
    const { data } = await http.post('/api/v1/logout');
    return data;
}
