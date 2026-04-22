<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Package, Folder, AlertTriangle, ArrowRight } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const props = defineProps<{
    name?: string;
    stats: {
        total_products: number;
        total_categories: number;
        low_stock: number;
    };
    recent_products: any[];
}>();
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-6 bg-white">

            <div class="grid gap-4 md:grid-cols-3">
                <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-500">Total Products</p>
                            <h3 class="text-3xl font-bold text-brand-blue">{{ stats.total_products }}</h3>
                        </div>
                        <div class="p-3 bg-brand-blue/10 rounded-lg">
                            <Package class="size-6 text-brand-blue" />
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-500">Categories</p>
                            <h3 class="text-3xl font-bold text-neutral-800">{{ stats.total_categories }}</h3>
                        </div>
                        <div class="p-3 bg-neutral-100 rounded-lg">
                            <Folder class="size-6 text-neutral-600" />
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-500">Low Stock Items</p>
                            <h3 class="text-3xl font-bold text-red-600">{{ stats.low_stock }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg">
                            <AlertTriangle class="size-6 text-red-600" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 rounded-xl border border-neutral-200 bg-white shadow-sm overflow-hidden">
                <div class="p-5 border-b border-neutral-100 flex justify-between items-center">
                    <h3 class="font-bold text-neutral-800">Recently Added Products</h3>
                    <Link :href="route('products.index')"
                        class="text-sm text-brand-blue font-medium flex items-center hover:underline">
                        View All
                        <ArrowRight class="ml-1 size-4" />
                    </Link>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-neutral-50 text-neutral-500 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Product Name</th>
                                <th class="px-6 py-3 font-semibold">Category</th>
                                <th class="px-6 py-3 font-semibold">Stock</th>
                                <th class="px-6 py-3 font-semibold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <tr v-for="product in recent_products" :key="product.id"
                                class="hover:bg-neutral-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-neutral-900">{{ product.name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-neutral-100 rounded text-xs text-neutral-600">
                                        {{ product.category?.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        :class="product.quantity < 10 ? 'text-red-600 font-bold' : 'text-neutral-600'">
                                        {{ product.quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <Link :href="route('products.show', product)"
                                        class="text-brand-blue hover:text-blue-800 font-medium">
                                        Details
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
