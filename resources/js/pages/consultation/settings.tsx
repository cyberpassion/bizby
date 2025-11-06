import { useState } from 'react';
import { useForm } from 'react-hook-form';

import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { SettingsForm } from './components/module-forms';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Consultation Settings',
        href: '#',
    },
];

export default function ConsultationSettings() {
    const { register, handleSubmit, reset } = useForm();
    const [loading, setLoading] = useState(false);

    const onSubmit = async (data: any) => {
        setLoading(true);
        try {
            // Send to backend (Inertia or API)
            await fetch('/consultations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify(data),
            });

            alert('Consultation saved successfully!');
            reset();
        } catch (error) {
            console.error(error);
            alert('Error saving consultation.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation Settings" />
            <SettingsForm
                register={register}
                handleSubmit={handleSubmit}
                onSubmit={onSubmit}
                loading={loading}
            />
        </AppLayout>
    );
}
