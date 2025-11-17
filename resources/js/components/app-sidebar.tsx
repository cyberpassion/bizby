import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { apiGet } from '@/lib/cyp/apiHelpers';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { BookOpen } from 'lucide-react';
import { useEffect, useState } from 'react';
import AppLogo from './app-logo';

const footerNavItems: NavItem[] = [
    {
        label: 'Documentation',
        href: 'https://learn.udyogx.in',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    const [mainNavItems, setMainNavItems] = useState<NavItem[]>([]);
    useEffect(() => {
        async function fetchModules() {
            try {
                const response = await apiGet('lookups/sidebar-menu');
                const items = response.data.map((module: any) => ({
                    label: module.label,
                    href: module.href,
                    icon: module.icon,
                    children: module.children,
                }));
                setMainNavItems(items);
                console.log(
                    'Fetched nav items:',
                    JSON.stringify(response.data),
                );
            } catch (err) {
                console.error('Error fetching nav items:', err);
            }
        }

        fetchModules();
    }, []);
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
