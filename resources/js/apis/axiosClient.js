import axios from 'axios';

// -------------------------
// Environment config
// -------------------------
/*export const apiEnv = {
    apiHost: process.env.NEXT_PUBLIC_API_URL || 'http://localhost/api',
    authToken: process.env.NEXT_PUBLIC_API_AUTH_TOKEN || '', // optional
};*/

export const apiEnv = {
    apiHost: import.meta.env.VITE_API_BASE_URL || 'http://localhost/api',
    authToken: import.meta.env.VITE_API_AUTH_TOKEN || '', // optional
};

// -------------------------
// Axios instance
// -------------------------
const axiosInstance = axios.create({
    baseURL: apiEnv.apiHost,
    timeout: 15000, // 15s
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

// Optional: attach auth token to all requests
axiosInstance.interceptors.request.use((config) => {
    if (apiEnv.authToken) {
        config.headers = {
            ...config.headers,
            Authorization: `Bearer ${apiEnv.authToken}`,
        };
    }
    return config;
});

// -------------------------
// Laravel Response Handler
// -------------------------
const handleResponse = (response) => {
    const data = response.data;

    if (!data) {
        throw new Error('No response data from server');
    }

    // Expecting Laravel-style: { success, message, data, errors }
    if (data.success === false) {
        throw new Error(data.message || 'Server returned an error');
    }

    return data;
};

// -------------------------
// Centralized API Call
// -------------------------
export const apiCall = async ({
    method = 'GET',
    url,
    data = {},
    params = {},
    headers = {},
    log = true,
}) => {
    try {
        const config = {
            method,
            url,
            data,
            params,
            headers,
        };

        if (log) {
            console.log(`📡 API Call: [${method}] ${url}`, { data, params });
        }

        const response = await axiosInstance(config);
        return handleResponse(response);
    } catch (err) {
        console.error(
            `❌ API Call Failed: [${method}] ${url}`,
            err.response?.data || err.message,
        );
        // Return a normalized error object
        return {
            success: false,
            message:
                err.response?.data?.message || err.message || 'Unknown error',
            status: err.response?.status || 500,
            errors: err.response?.data?.errors || null,
            data: null,
        };
    }
};

// -------------------------
// Shortcut Wrappers
// -------------------------
export const apiGet = (url, params = {}, headers = {}, log = true) =>
    apiCall({ method: 'GET', url, params, headers, log });

export const apiPost = (url, data = {}, headers = {}, log = true) =>
    apiCall({ method: 'POST', url, data, headers, log });

export const apiPut = (url, data = {}, headers = {}, log = true) =>
    apiCall({ method: 'PUT', url, data, headers, log });

export const apiPatch = (url, data = {}, headers = {}, log = true) =>
    apiCall({ method: 'PATCH', url, data, headers, log });

export const apiDelete = (url, params = {}, headers = {}, log = true) =>
    apiCall({ method: 'DELETE', url, params, headers, log });
