import { apiGet } from '@/apis/axiosClient'; // centralized Axios
import { DynamicForm } from '@/components/cyp/dynamic-form';
import AppLayout from '@/layouts/app-layout';
import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';

const breadcrumbs = [
    {
        title: 'Create',
        href: '#',
    },
];

export default function ConsultationForm() {
    const { props } = usePage();
    const form = props.form;
    const [schema, setSchema] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchSchema = async () => {
            try {
                const res = await apiGet(`/form/${form}`);
                console.log('🔥 FORM SCHEMA RESPONSE:', res);

                // Laravel response assumed: { status, data, message, errors }
                if (res.status) {
                    setSchema(res.schema); // adjust based on your API response
                } else {
                    console.error('❌ API returned error:', res.message);
                }
            } catch (err) {
                console.error('❌ Error loading schema:', err);
            } finally {
                setLoading(false);
            }
        };

        fetchSchema();
    }, [form]);

    if (loading) return <p>Loading...</p>;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create" />
            {schema ? (
                <DynamicForm schema={schema} submitTo="/consultation/store" />
            ) : (
                <p>No schema found</p>
            )}
        </AppLayout>
    );
}
