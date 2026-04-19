<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { computed, watch } from 'vue';


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
const categories = computed(() => page.props.categories);

const form = useForm({
    selected_category: page.props.filters?.category_id || null,
});

watch(() => form.selected_category, (value) => {
    router.get(route('products.index'), { category_id: value }, {
        preserveState: true,
        replace: true
    });
});
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
            <div class="my-5 flex">
                <h1>Select category:</h1>
                <select id="category_id" v-model="form.selected_category">
                    <option :value="null">All Categories</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <table class="table-auto border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 ...">ID</th>
                        <th class="border border-gray-300 ...">Product Name</th>
                        <th class="border border-gray-300 ...">Category</th>
                        <th class="border border-gray-300 ...">Quantity</th>
                        <th class="border border-gray-300 ...">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="products.length > 0">
                        <tr v-for="product in products">
                            <td class="border border-gray-300 ...">{{ product.id }}</td>
                            <td class="border border-gray-300 ...">
                                <Link class="underline" :href="route('products.show', product)">
                                    {{ product.name }}
                                </Link>
                            </td>
                            <td class="border border-gray-300 ...">{{ product.category.name }}</td>
                            <td class="border border-gray-300 ...">{{ product.quantity }}</td>
                            <td class="border border-gray-300 ...">{{ product.formatted_date }}</td>
                        </tr>
                    </template>
                    <tr v-else>
                        <td colspan="5" class="border border-gray-300 p-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-lg font-medium">No products found</span>
                                <p>Try adjusting your category filter or search criteria.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
