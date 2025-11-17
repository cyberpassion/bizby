import { DynamicForm } from '@/components/cyp/dynamic-form';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create',
        href: '#',
    },
];

export default function ConsultationForm() {
    const { props } = usePage();
    const form = props.form;
    const [schema, setSchema] = useState<any>(null);

    useEffect(() => {
        fetch(`/api/v1/form/${form}`)
            .then((r) => r.json())
            .then((res) => {
                console.log('🔥 FORM SCHEMA RESPONSE:', res);
                setSchema(res.schema);
            })
            .catch((err) => console.error('❌ Error loading schema:', err));
    }, []);

    if (!schema) return <p>Loading...</p>;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create" />
            <DynamicForm schema={schema} />
        </AppLayout>
    );
}
