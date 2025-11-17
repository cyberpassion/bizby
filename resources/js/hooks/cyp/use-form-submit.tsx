import { useState } from 'react';

interface UseFormSubmitOptions {
    url: string;
    onSuccess?: (response: any, data: any) => void;
    onError?: (error: any) => void;
    reset?: () => void;
}

export function useFormSubmit({
    url,
    onSuccess,
    onError,
    reset,
}: UseFormSubmitOptions) {
    const [loading, setLoading] = useState(false);

    const handleFormSubmit = async (data: any) => {
        setLoading(true);

        try {
            console.log('Submitting to URL:', url);
            console.log('Submitting data:', data);

            // Get CSRF token from <meta> tag
            const csrfToken =
                document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content') ?? '';

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // ✔ required
                    'X-Requested-With': 'XMLHttpRequest', // ✔ required for Laravel AJAX
                },
                credentials: 'same-origin', // ✔ send cookies for CSRF session validation
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                const errorPayload = await response.json().catch(() => null);
                throw errorPayload ?? new Error('Failed to submit form');
            }

            const json = await response.json().catch(() => ({}));

            onSuccess?.(json, data);
            reset?.();
        } catch (error) {
            console.error('Submit error:', error);
            onError?.(error);
        } finally {
            setLoading(false);
        }
    };

    return { handleFormSubmit, loading };
}
