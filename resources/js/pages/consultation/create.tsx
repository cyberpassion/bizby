import { useFormSubmit } from '@/hooks/cyp/use-form-submit';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useForm } from 'react-hook-form';
import { EntryForm } from './components/module-forms';

import { module } from './about';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: module.label + ' Create',
        href: '#',
    },
];

export default function ConsultationCreate() {
    const { register, handleSubmit, reset } = useForm();

    const { handleFormSubmit, loading } = useFormSubmit({
        url: '/consultations',
        onSuccess: (response: any, data: any) => {
            alert('Saved successfully!');
            reset();
        },
        onError: (error) => {
            console.error(error);
            alert('Error saving form.');
        },
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation Create" />
            <EntryForm
                register={register}
                handleSubmit={handleSubmit}
                onSubmit={handleFormSubmit}
                loading={loading}
            />
        </AppLayout>
    );
}
