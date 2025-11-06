import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Edit, Eye, MoreHorizontal, Trash2 } from 'lucide-react';

import { SelectWithLabel } from '@/components/cyp/select-with-label';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Consultation List',
        href: '#',
    },
];

export default function ConsultationIndex() {
    const { consultations } = usePage().props as {
        consultations: Array<{
            id: number;
            consultation_with: string;
            date: string;
            status: string;
        }>;
    };

    // Define filters for the consultation list
    const listFilters = [
        {
            label: '',
            id: 'doctor',
            placeholder: 'Select Doctor',
            module: 'consultation',
            dataKey: 'doctor-json',
            col: 3,
        },
        {
            label: '',
            id: 'date',
            placeholder: 'Select Date',
            module: 'consultation',
            dataKey: 'date-json',
            col: 3,
        },
        {
            label: '',
            id: 'mode',
            placeholder: 'Select Mode',
            module: 'consultation',
            dataKey: 'mode-json',
            col: 3,
        },
        {
            label: '',
            id: 'status',
            placeholder: 'Select Status',
            module: 'consultation',
            dataKey: 'consultation_status-json',
            col: 3,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation List" />

            <Card className="m-2 rounded-xl border border-sidebar-border/70 bg-white p-2 text-center shadow-none">
                <div className="flex items-center justify-between">
                    {listFilters.map((filter) => (
                        <SelectWithLabel
                            key={filter.id}
                            label={filter.label}
                            id={filter.id}
                            placeholder={filter.placeholder}
                            module={filter.module}
                            dataKey={filter.dataKey}
                            col={filter.col}
                        />
                    ))}
                    <Link href="/consultation/create">
                        <Button>Add Consultation</Button>
                    </Link>
                </div>
            </Card>
            <Card className="w-full border-0 pt-0 shadow-none">
                <CardContent>
                    {consultations && consultations.length > 0 ? (
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[50px]">
                                        #
                                    </TableHead>
                                    <TableHead>Consultation With</TableHead>
                                    <TableHead>Date</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead className="text-right">
                                        Actions
                                    </TableHead>
                                </TableRow>
                            </TableHeader>

                            <TableBody>
                                {consultations.map((item, index) => (
                                    <TableRow key={item.id ?? index}>
                                        <TableCell>{index + 1}</TableCell>
                                        <TableCell>
                                            {item.consultation_with}
                                        </TableCell>
                                        <TableCell>{item.date}</TableCell>
                                        <TableCell>{item.status}</TableCell>
                                        <TableCell className="text-right">
                                            <DropdownMenu>
                                                <DropdownMenuTrigger asChild>
                                                    <Button
                                                        variant="ghost"
                                                        size="icon"
                                                        className="h-8 w-8"
                                                    >
                                                        <MoreHorizontal className="h-4 w-4" />
                                                    </Button>
                                                </DropdownMenuTrigger>
                                                <DropdownMenuContent align="end">
                                                    <DropdownMenuItem asChild>
                                                        <Link
                                                            href={`/consultation/${item.id}/view`}
                                                        >
                                                            <Eye className="mr-2 h-4 w-4" />{' '}
                                                            View
                                                        </Link>
                                                    </DropdownMenuItem>
                                                    <DropdownMenuItem asChild>
                                                        <Link
                                                            href={`/consultation/${item.id}/edit`}
                                                        >
                                                            <Edit className="mr-2 h-4 w-4" />{' '}
                                                            Edit
                                                        </Link>
                                                    </DropdownMenuItem>
                                                    <DropdownMenuItem
                                                        onClick={() =>
                                                            confirm(
                                                                `Are you sure you want to delete ${item.consultation_with}?`,
                                                            )
                                                        }
                                                        className="text-red-600"
                                                    >
                                                        <Trash2 className="mr-2 h-4 w-4" />{' '}
                                                        Delete
                                                    </DropdownMenuItem>
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    ) : (
                        <p className="py-6 text-center text-gray-500 dark:text-gray-400">
                            No consultations found.
                        </p>
                    )}
                </CardContent>
            </Card>
        </AppLayout>
    );
}
