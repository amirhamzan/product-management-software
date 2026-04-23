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
        <SidebarHeader class="bg-brand-yellow">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child class="hover:bg-brand-yellow/80 active:bg-brand-yellow transition-colors">
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="bg-brand-blue px-3 py-4">
            <div class="space-y-1">
                <Link :href="route('dashboard')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('dashboard')
                        ? 'bg-white/10 text-white shadow-sm'
                        : 'text-blue-100 hover:bg-white/5 hover:text-white'
                ]">
                    <LayoutGrid
                        :class="['size-5', route().current('dashboard') ? 'text-white' : 'text-blue-200 group-hover:text-white']" />
                    <span>Dashboard</span>
                </Link>

                <Link :href="route('categories.index')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('categories.*')
                        ? 'bg-white/10 text-white shadow-sm'
                        : 'text-blue-100 hover:bg-white/5 hover:text-white'
                ]">
                    <Folder
                        :class="['size-5', route().current('categories.*') ? 'text-white' : 'text-blue-200 group-hover:text-white']" />
                    <span>Categories</span>
                </Link>

                <Link :href="route('products.index')" :class="[
                    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group',
                    route().current('products.*')
                        ? 'bg-white/10 text-white shadow-sm'
                        : 'text-blue-100 hover:bg-white/5 hover:text-white'
                ]">
                    <ListChecks
                        :class="['size-5', route().current('products.*') ? 'text-white' : 'text-blue-200 group-hover:text-white']" />
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
