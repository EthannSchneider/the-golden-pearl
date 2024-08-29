import axios from 'axios';

export function is_login() {
    return axios.get('/api/auth')
}

export function login(username, password) {
    return axios.post('/api/auth/login', { username: username, password: password })
}

export function logout() {
    return axios.get('/api/auth/logout');
}