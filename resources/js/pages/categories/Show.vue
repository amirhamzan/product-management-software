<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    name?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show Category',
        href: '/categories/show',
    },
];

const form = useForm({
    name: null,
    description: null,
});

const page = usePage();

const category = computed(() => page.props.category);

function deleteItem(category: any) {
    if (confirm('Are you sure you want to delete this item?')) {
        router.delete(route('categories.destroy', category), {});
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head :title="category.name" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="p-6 rounded-md rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base/7 font-semibold text-gray-900">ID: {{ category.id }}, {{ category.name }}
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                            <div class="mt-2">
                                <input disabled id="name" type="text" v-model="category.name" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 bg-gray-50" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="description"
                                class="block text-sm/6 font-medium text-gray-900">Description</label>
                            <div class="mt-2">
                                <input disabled="" id="description" type="text" v-model="category.description"
                                    autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 bg-gray-50"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Date Created</label>
                            <div class="mt-2">
                                <input disabled id="name" type="text" v-model="category.created_at" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 bg-gray-50"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Date Updated</label>
                            <div class="mt-2">
                                <input disabled id="name" type="text" v-model="category.updated_at" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 bg-gray-50"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-10 pt-4 mt-4">
                        <div>
                            <Link class="mr-6" :href="route('categories.edit', category)">
                                <Button class="bg-brand-blue hover:bg-blue-700 text-white px-8">
                                    <button>Edit</button>
                                </Button>
                            </Link>
                            <Link :href="route('categories.index')">
                                <Button variant="outline">
                                    <button>Return to list of categories</button>
                                </Button>
                            </Link>
                        </div>
                        <Button @click="deleteItem(category)" variant="destructive">
                            Delete Category
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
