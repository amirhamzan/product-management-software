<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, ChevronsUpDown, Folder, LayoutGrid, ListChecks } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import NavigationMenuLink from './ui/navigation-menu/NavigationMenuLink.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Categories',
        href: '/categories',
        icon: Folder,
    },
    {
        title: 'Products',
        href: '/product',
        icon: ListChecks,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader class="bg-brand-blue">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="bg-neutral-100 px-3 py-4">
            <div class="space-y-1">
                <Link :href="route('dashboard')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('dashboard')
                        ? 'bg-white text-brand-blue shadow-sm border border-neutral-200'
                        : 'text-neutral-600 hover:bg-neutral-200/50 hover:text-brand-blue'
                ]">
                    <LayoutGrid
                        :class="['size-5', route().current('dashboard') ? 'text-brand-blue' : 'text-brand-blue group-hover:text-brand-blue']" />
                    <span>Dashboard</span>
                </Link>

                <Link :href="route('categories.index')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('categories.*')
                        ? 'bg-white text-brand-blue shadow-sm border border-neutral-200'
                        : 'text-neutral-600 hover:bg-neutral-200/50 hover:text-brand-blue'
                ]">
                    <Folder
                        :class="['size-5', route().current('categories.*') ? 'text-brand-blue' : 'text-brand-blue group-hover:text-brand-blue']" />
                    <span>Categories</span>
                </Link>

                <Link :href="route('products.index')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('products.*')
                        ? 'bg-white text-brand-blue shadow-sm border border-neutral-200'
                        : 'text-neutral-600 hover:bg-neutral-200/50 hover:text-brand-blue'
                ]">
                    <ListChecks
                        :class="['size-5', route().current('products.*') ? 'text-brand-blue' : 'text-brand-blue group-hover:text-brand-blue']" />
                    <span>Products</span>
                </Link>
            </div>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
