<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { computed, watch } from 'vue';
import { Plus, X } from 'lucide-vue-next';
import TableBase from '@/components/product-management-system/TableBase.vue';

// Combine all props into one definition
const props = defineProps<{
    name?: string;
    products: {};
    categories: any[];
    filters: {
        category_id?: number | null;
        sort_by?: string;
        direction?: 'asc' | 'desc';
    };
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

const sort = (field: string) => {
    let direction = props.filters.direction === 'asc' ? 'desc' : 'asc';

    if (props.filters.sort_by !== field) {
        direction = 'asc';
    }

    router.get(route('products.index'), {
        ...props.filters,
        sort_by: field,
        direction: direction
    }, { preserveState: true });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Products" />

        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4 lg:p-8">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Products</h1>
                    <p class="text-sm text-muted-foreground">Manage your inventory and stock levels.</p>
                </div>

                <Link :href="route('products.create')">
                    <Button class="bg-brand-blue hover:bg-blue-700 text-white shadow-sm">
                        <Plus class="mr-2 h-4 w-4" />
                        Add Product
                    </Button>
                </Link>
            </div>

            <div
                class="flex flex-wrap items-center gap-3 bg-white p-4 rounded-xl border border-gray-200 shadow-sm dark:bg-[#161615] dark:border-[#262624]">
                <div class="flex items-center gap-2">
                    <label for="category_id"
                        class="text-sm font-medium text-gray-700 dark:text-gray-300">Category:</label>
                    <select id="category_id" v-model="form.selected_category"
                        class="rounded-md border-gray-300 py-1.5 pl-3 pr-8 text-sm focus:border-brand-blue focus:ring-brand-blue dark:bg-[#1C1C1B] dark:border-[#262624]">
                        <option :value="null">All Categories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <Link
                    v-if="route().current() !== 'products.index' || Object.values(filters).some(v => v !== null && v !== 'id' && v !== 'desc')"
                    :href="route('products.index')">
                    <Button variant="outline" size="sm" class="h-9">
                        <X class="mr-2 h-3 w-3" />
                        Clear filters
                    </Button>
                </Link>
            </div>

            <TableBase :items="products.data" :pagination="products"
                :headers="['ID', 'Product Name', 'Category', 'Stock', 'Created']">
                <template #header-cells>
                    <th @click="sort('id')"
                        class="cursor-pointer px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-brand-blue">
                        ID {{ (!filters.sort_by || filters.sort_by === 'id') ? (filters.direction === 'asc'
                            ? '↑' : '↓') : '' }}
                    </th>
                    <th @click="sort('name')"
                        class="cursor-pointer px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-brand-blue">
                        Product Name {{ filters.sort_by === 'name' ? (filters.direction === 'asc' ? '↑' :
                            '↓') : '' }}
                    </th>
                    <th @click="sort('category_id')"
                        class="cursor-pointer px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-brand-blue">
                        Category {{ filters.sort_by === 'category_id' ? (filters.direction === 'asc' ? '↑' :
                            '↓') : '' }}
                    </th>
                    <th @click="sort('quantity')"
                        class="cursor-pointer px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-brand-blue">
                        Stock {{ filters.sort_by === 'quantity' ? (filters.direction === 'asc' ? '↑' : '↓')
                            : '' }}
                    </th>
                    <th @click="sort('created_at')"
                        class="cursor-pointer px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 hover:text-brand-blue">
                        Created {{ filters.sort_by === 'created_at' ? (filters.direction === 'asc' ? '↑' :
                            '↓') : '' }}
                    </th>
                </template>

                <template #rows>
                    <tr v-for="product in products.data" :key="product.id"
                        class="group hover:bg-gray-50/50 dark:hover:bg-[#1E1E1D] transition-colors">
                        <td class="px-6 py-4 text-sm text-muted-foreground">#{{ product.id }}</td>
                        <td class="px-6 py-4 text-sm">
                            <Link class="font-medium text-brand-blue hover:underline underline-offset-4"
                                :href="route('products.show', product)">
                                {{ product.name }}
                            </Link>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            <span
                                class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-400/10 dark:text-blue-400">
                                {{ product.category.name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-mono">{{ product.quantity.toLocaleString() }}</td>
                        <td class="px-6 py-4 text-sm text-muted-foreground">{{ product.formatted_date }}
                        </td>
                    </tr>
                </template>
            </TableBase>
        </div>
    </AppLayout>
</template>
