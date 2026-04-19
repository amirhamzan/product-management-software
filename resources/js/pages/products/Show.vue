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
        title: 'Show Product',
        href: '/products/show',
    },
];

const form = useForm({
    name: null,
    category_id: null,
    quantity: 1,
});

const page = usePage();

const product = computed(() => page.props.product);

function deleteItem(product: any) {
    if (confirm('Are you sure you want to delete this item?')) {
        router.delete(route('products.destroy', product), {});
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head :title="product.name" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base/7 font-semibold text-gray-900">ID: {{ product.id }}, {{ product.name }}
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                            <div class="mt-2">
                                <input disabled id="name" type="text" v-model="product.name" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="category_name" class="block text-sm/6 font-medium text-gray-900">Category
                                Name</label>
                            <div class="mt-2">
                                <input disabled id="category_name" type="text" v-model="product.category.name"
                                    autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="quantity" class="block text-sm/6 font-medium text-gray-900">Quantity</label>
                            <div class="mt-2">
                                <input disabled id="quantity" type="text" v-model="product.quantity" autocomplete="off"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <Link :href="route('products.index')">
                            <Button variant="default">
                                <button>Edit</button>
                            </Button>
                        </Link>
                        <Link :href="route('products.index')">
                            <Button variant="outline">
                                <button>Back to list of products</button>
                            </Button>
                        </Link>
                    </div>
                    <div class="mt-5 flex justify-between items-center">
                        <Button @click="deleteItem(product)" variant="destructive">
                            Delete Product
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
