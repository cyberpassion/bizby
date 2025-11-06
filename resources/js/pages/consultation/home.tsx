import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import {
    BarChart2,
    Calendar,
    FileText,
    MessageSquare,
    Settings,
} from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Consultation Home',
        href: dashboard().url,
    },
];

export default function Home() {
    const buttons = [
        {
            title: 'Start New Consultation',
            href: '/consultation/create',
            icon: MessageSquare,
        },
        {
            title: 'View All Consultations',
            href: '/consultations',
            icon: FileText,
        },
        {
            title: 'Schedule Follow-up',
            href: '/consultation/schedule',
            icon: Calendar,
        },
        {
            title: 'Consultation Reports',
            href: '/consultation/report',
            icon: BarChart2,
        },
        {
            title: 'Consultation Settings',
            href: '/consultation/settings',
            icon: Settings,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation Home" />
            <div className="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4">
                {/* Top Button Grid */}
                <div className="grid gap-4 md:grid-cols-3 lg:grid-cols-5">
                    {buttons.map((btn, i) => (
                        <Link key={i} href={btn.href} className="block">
                            <div className="flex flex-col items-center justify-center gap-3 rounded-xl border border-sidebar-border/70 bg-white p-6 text-center">
                                <btn.icon
                                    className="h-10 w-10 text-primary opacity-80"
                                    strokeWidth={1.25} // thinner lines
                                />
                                <span className="text-sm font-medium">
                                    {btn.title}
                                </span>
                                <Button
                                    variant="outline"
                                    size="sm"
                                    className="mt-2"
                                >
                                    Go
                                </Button>
                            </div>
                        </Link>
                    ))}
                </div>

                {/* Placeholder Section */}
                <div className="relative flex min-h-[60vh] flex-1 items-center justify-center overflow-hidden rounded-xl border border-sidebar-border/70 text-neutral-500 md:min-h-min dark:border-sidebar-border">
                    Select an option above to begin.
                </div>
            </div>
        </AppLayout>
    );
}
