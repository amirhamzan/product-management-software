<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    name?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    },
];

const page = usePage();

const categories = computed(() => page.props.categories);
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
                        <th class="border border-gray-300 ...">ID</th>
                        <th class="border border-gray-300 ...">Category Name</th>
                        <th class="border border-gray-300 ...">Description</th>
                        <th class="border border-gray-300 ...">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories">
                        <td class="border border-gray-300 ...">{{ category.id }}</td>
                        <td class="border border-gray-300 ...">
                            <Link class="underline" :href="route('categories.show', category)">
                                {{ category.name }}
                            </Link>
                        </td>
                        <td class="border border-gray-300 ...">{{ category.description }}</td>
                        <td class="border border-gray-300 ...">{{ category.formatted_date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
