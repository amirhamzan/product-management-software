<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { computed } from 'vue';
import TableBase from '@/components/product-management-system/TableBase.vue';

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

        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4 lg:p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">List of categories</h1>
                    <p class="text-sm text-muted-foreground">Manage your product organization and taxonomy.</p>
                </div>

                <Link :href="route('categories.create')">
                    <Button class="bg-brand-blue hover:bg-blue-700 text-white">
                        <Plus class="mr-2 h-4 w-4" />
                        Add category
                    </Button>
                </Link>
            </div>

            <TableBase :headers="['ID', 'Category Name', 'Description', 'Created At']" :items="categories.data" :pagination="categories"
                empty-text="No categories found">
                <template #rows>
                    <tr v-for="category in categories.data" :key="category.id"
                        class="group hover:bg-gray-50/50 dark:hover:bg-[#1E1E1D] transition-colors">

                        <td class="px-6 py-4 text-sm text-muted-foreground">#{{ category.id }}</td>

                        <td class="px-6 py-4">
                            <Link :href="route('categories.show', category)"
                                class="font-medium text-brand-blue hover:underline decoration-2 underline-offset-4">
                                {{ category.name }}
                            </Link>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ category.description || '—' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-muted-foreground">
                            {{ category.formatted_date }}
                        </td>
                    </tr>
                </template>
            </TableBase>
        </div>
    </AppLayout>
</template>
