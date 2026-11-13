import axios from "axios";

const API_URL = 'http://localhost/api/v1/';

export const publicApi = axios.create({
    baseURL: API_URL,
    timeout: 10000,
    headers: {
        'Content-Type' : 'application/json'
    }
});