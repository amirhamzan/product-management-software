<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Package, Folder, AlertTriangle, ArrowRight } from 'lucide-vue-next';
import TableBase from '@/components/product-management-system/TableBase.vue';

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
                <div class="p-5 flex justify-between items-center">
                    <h3 class="font-bold text-neutral-800">Recently Added Products</h3>
                    <Link :href="route('products.index')"
                        class="text-sm text-brand-blue font-medium flex items-center hover:underline">
                        View All
                        <ArrowRight class="ml-1 size-4" />
                    </Link>
                </div>

                <TableBase :headers="['Product Name', 'Category', 'Stock', 'Action']" :items="recent_products"
                    empty-text="No recent products added">
                    <template #header-cells>
                        <th
                            class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 whitespace-nowrap">
                            Product Name</th>
                        <th
                            class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 whitespace-nowrap">
                            Category</th>
                        <th
                            class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 whitespace-nowrap">
                            Stock</th>
                    </template>

                    <template #rows>
                        <tr v-for="product in recent_products" :key="product.id"
                            class="group hover:bg-gray-50/50 dark:hover:bg-[#1E1E1D] transition-colors">

                            <td class="px-6 py-4 text-sm font-medium text-neutral-900 dark:text-white">
                                <Link
                                    class="text-brand-blue hover:text-blue-800 font-medium hover:underline decoration-2 underline-offset-4"
                                    :href="route('products.show', product)">{{ product.name }}</Link>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-400/10 dark:text-blue-400">
                                    {{ product.category?.name }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm">
                                <span
                                    :class="product.quantity < 10 ? 'text-red-600 font-bold' : 'text-neutral-600 dark:text-gray-400'">
                                    {{ product.quantity.toLocaleString() }}
                                </span>
                            </td>
                        </tr>
                    </template>
                </TableBase>
            </div>
        </div>
    </AppLayout>
</template>
