import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { Printer } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Consultations', href: '/consultations' },
    { title: 'View Consultation', href: '#' },
];

export default function ConsultationShow() {
    const { consultation } = usePage().props as {
        consultation: {
            id: number;
            consultation_with: string;
            date: string;
            status: string;
            notes?: string; // optional extra info
        };
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="View Consultation" />

            {/* Main Slip Card */}
            <Card className="w-full border-none shadow-none">
                <CardContent>
                    <div className="mx-auto my-2 p-2">
                        {/* Header */}
                        <div className="flex items-center justify-between">
                            <h2 className="text-2xl font-bold">
                                Consultation Slip
                            </h2>
                            <Button
                                size="sm"
                                variant="outline"
                                onClick={() => window.print()}
                            >
                                <Printer className="mr-2 h-4 w-4" /> Print
                            </Button>
                        </div>
                    </div>
                    {/* Consultation Info */}
                    <Table>
                        <TableBody>
                            <TableRow>
                                <TableCell className="font-semibold">
                                    ID
                                </TableCell>
                                <TableCell>{consultation.id}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell className="font-semibold">
                                    Consultation With
                                </TableCell>
                                <TableCell>
                                    {consultation.consultation_with}
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell className="font-semibold">
                                    Date
                                </TableCell>
                                <TableCell>{consultation.date}</TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell className="font-semibold">
                                    Status
                                </TableCell>
                                <TableCell>{consultation.status}</TableCell>
                            </TableRow>

                            {consultation.notes && (
                                <TableRow>
                                    <TableCell className="font-semibold">
                                        Notes
                                    </TableCell>
                                    <TableCell>{consultation.notes}</TableCell>
                                </TableRow>
                            )}
                        </TableBody>
                    </Table>

                    {/* Footer */}
                    <div className="mt-6 text-center text-sm text-gray-500">
                        Thank you for your visit!
                    </div>
                </CardContent>
            </Card>
        </AppLayout>
    );
}
