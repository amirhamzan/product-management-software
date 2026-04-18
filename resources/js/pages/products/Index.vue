<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { computed } from 'vue';


defineProps<{
    name?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const page = usePage();

const products = computed(() => page.props.products);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Products" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex justify-between items-center">
                <h1>List of products</h1>
                <Link :href="route('products.create')">
                    <Button variant="default">
                        <button>Add product</button>
                    </Button>
                </Link>
            </div>
            <table class="table-auto border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 ...">ID</th>
                        <th class="border border-gray-300 ...">Product Name</th>
                        <th class="border border-gray-300 ...">Category</th>
                        <th class="border border-gray-300 ...">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products">
                        <td class="border border-gray-300 ...">{{ product.id }}</td>
                        <td class="border border-gray-300 ...">{{ product.name }}</td>
                        <td class="border border-gray-300 ...">{{ product.category.name }}</td>
                        <td class="border border-gray-300 ...">{{ product.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
