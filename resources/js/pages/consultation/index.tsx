import { Card, CardContent } from '@/components/ui/card';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Consultation List',
        href: '#',
    },
];

export default function ConsultationIndex() {
    const { consultations } = usePage().props;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation List" />
            <div className="min-h-screen bg-gray-50 p-6">
                <Card className="w-full shadow-lg">
                    <CardContent>
                        {consultations && consultations.length > 0 ? (
                            <table className="w-full rounded-lg border border-gray-200 text-left">
                                <thead className="bg-gray-100">
                                    <tr>
                                        <th className="border p-2">#</th>
                                        <th className="border p-2">
                                            Consultation With
                                        </th>
                                        <th className="border p-2">Date</th>
                                        <th className="border p-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {consultations.map((item, index) => (
                                        <tr
                                            key={item.id || index}
                                            className="hover:bg-gray-50"
                                        >
                                            <td className="border p-2">
                                                {index + 1}
                                            </td>
                                            <td className="border p-2">
                                                {item.consultation_with}
                                            </td>
                                            <td className="border p-2">
                                                {item.date}
                                            </td>
                                            <td className="border p-2">
                                                {item.status}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        ) : (
                            <p className="py-4 text-center text-gray-600">
                                No consultations found.
                            </p>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
