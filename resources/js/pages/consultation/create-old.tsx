import { useFormSubmit } from '@/hooks/cyp/use-form-submit';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { useForm } from 'react-hook-form';
import { EntryForm } from './components/module-forms';

import { module } from './about';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: module.label + ' Create',
        href: '#',
    },
];

export default function Create() {
    const { props } = usePage();
    const storeUrl = props.storeUrl;
    const { register, handleSubmit, reset } = useForm();

    const { handleFormSubmit, loading } = useFormSubmit({
        url: storeUrl,
        onSuccess: (response: any, data: any) => {
            alert(JSON.stringify(response));
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
            <Head title="Create" />
            <EntryForm
                register={register}
                handleSubmit={handleSubmit}
                onSubmit={handleFormSubmit}
                reset={reset}
                loading={loading}
            />
        </AppLayout>
    );
}
