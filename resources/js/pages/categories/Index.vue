<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    name?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Categories" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex justify-between items-center">
                <h1>List of categories</h1>
                <Link :href="route('categories.create')">
                    <Button variant="default">
                        <button>Add category</button>
                    </Button>
                </Link>
            </div>
            <table class="table-auto border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 ...">State</th>
                        <th class="border border-gray-300 ...">City</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 ...">Indiana</td>
                        <td class="border border-gray-300 ...">Indianapolis</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 ...">Ohio</td>
                        <td class="border border-gray-300 ...">Columbus</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 ...">Michigan</td>
                        <td class="border border-gray-300 ...">Detroit</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
