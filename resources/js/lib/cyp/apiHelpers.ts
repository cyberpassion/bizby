const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

interface ApiOptions extends RequestInit {
    headers?: HeadersInit;
    body?: any;
}

/**
 * Generic GET request
 */
export async function apiGet(path: string, options: ApiOptions = {}) {
    const res = await fetch(`${API_BASE_URL}/${path}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            ...options.headers,
        },
        ...options,
    });

    return handleResponse(res);
}

/**
 * Generic POST request
 */
export async function apiPost(
    path: string,
    body: any,
    options: ApiOptions = {},
) {
    const res = await fetch(`${API_BASE_URL}/${path}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':
                document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content') || '',
            ...options.headers,
        },
        body: JSON.stringify(body),
        ...options,
    });

    return handleResponse(res);
}

/**
 * Handle the response, throw error if status is not ok
 */
async function handleResponse(res: Response) {
    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
        throw new Error(data.message || `API Error: ${res.status}`);
    }

    return data;
}
