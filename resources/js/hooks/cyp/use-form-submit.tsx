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
            console.log('Data:', JSON.stringify(data));
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN':
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content') ?? '',
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) throw new Error('Failed to submit form');

            onSuccess?.(response, data);
            reset?.();
        } catch (error) {
            console.error(error);
            onError?.(error);
        } finally {
            setLoading(false);
        }
    };

    return { handleFormSubmit, loading };
}
