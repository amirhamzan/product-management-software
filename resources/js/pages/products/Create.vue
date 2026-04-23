<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    name?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Product',
        href: '/products/create',
    },
];

const form = useForm({
    name: null,
    category_id: null,
    quantity: 1,
});

const page = usePage();

const categories = computed(() => page.props.categories);

const submitForm = () => {
    form.post(route('products.store'), {
        onError: (errors) => {
            console.log("Validation failed:", errors);
        },
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Create Product" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="p-6 rounded-md rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base/7 font-semibold text-gray-900">Add Product</h2>
                        <p class="mt-1 text-sm/6 text-gray-600">Use a unique product name.</p>
                    </div>
                </div>
                <form @submit.prevent="submitForm">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3 border-b border-gray-900/10">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                            <div class="mt-2">
                                <input required id="name" type="text" v-model="form.name" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3 border-b border-gray-900/10">
                            <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Category
                                Name</label>
                            <div class="mt-2">
                                <select required id="category_id" v-model="form.category_id"
                                    class="block w-full rounded-lg border-gray-300 dark:border-[#262624] dark:bg-[#1C1C1B] text-sm focus:ring-brand-blue focus:border-brand-blue shadow-sm">
                                    <option disabled value="">Select a category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.category_id }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3 border-b border-gray-900/10">
                            <label for="quantity" class="block text-sm/6 font-medium text-gray-900">Quantity</label>
                            <div class="mt-2">
                                <input id="quantity" min="1" type="number" v-model="form.quantity" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                <p v-if="form.errors.quantity" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.quantity }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-start gap-10 pt-4">
                        <Button type="submit" class="bg-brand-blue hover:bg-blue-700 text-white px-8">
                            Create Product
                        </Button>
                        <Link :href="route('products.index')">
                            <Button variant="outline" type="button">Cancel</Button>
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
