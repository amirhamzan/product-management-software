<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { computed, watch } from 'vue';

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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex justify-between items-center">
                <h1>List of products</h1>
                <Link :href="route('products.create')">
                    <Button variant="default">
                        <button>Add product</button>
                    </Button>
                </Link>
            </div>
            <div class="my-5 flex items-center">
                <h1>Select category:</h1>
                <select id="category_id" v-model="form.selected_category">
                    <option :value="null">All Categories</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
                <Link
                    v-if="route().current() !== 'products.index' || Object.values(filters).some(v => v !== null && v !== 'id' && v !== 'desc')"
                    class="ml-5" :href="route('products.index')">
                    <Button variant="outline" size="sm">
                        <button>Clear search</button>
                    </Button>
                </Link>
            </div>
            <table class="table-auto border border-gray-400">
                <thead>
                    <tr class="bg-gray-100">
                        <th @click="sort('id')" class="cursor-pointer border border-gray-300 p-2 hover:bg-gray-200">
                            ID
                            {{
                                (!filters.sort_by || filters.sort_by === 'id')
                                    ? (filters.direction === 'asc' ? '↑' : '↓')
                                    : ''
                            }}
                        </th>
                        <th @click="sort('name')" class="cursor-pointer border border-gray-300 p-2 hover:bg-gray-200">
                            Product Name {{ filters.sort_by === 'name' ? (filters.direction === 'asc' ? '↑' : '↓') : ''
                            }}
                        </th>
                        <!-- <th class="border border-gray-300 p-2">Category</th> -->
                        <th @click="sort('category_id')"
                            class="cursor-pointer border border-gray-300 p-2 hover:bg-gray-200">
                            Category {{ filters.sort_by === 'category_id' ? (filters.direction === 'asc' ? '↑' : '↓') :
                                ''
                            }}
                        </th>
                        <th @click="sort('quantity')"
                            class="cursor-pointer border border-gray-300 p-2 hover:bg-gray-200">
                            Quantity {{ filters.sort_by === 'quantity' ? (filters.direction === 'asc' ? '↑' : '↓') : ''
                            }}
                        </th>
                        <th @click="sort('created_at')"
                            class="cursor-pointer border border-gray-300 p-2 hover:bg-gray-200">
                            Created At {{ filters.sort_by === 'created_at' ? (filters.direction === 'asc' ? '↑' : '↓') :
                                '' }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="products.data.length > 0">
                        <tr v-for="product in products.data" :key="product.id">
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
                                <p>Try adjusting your category filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="products.data.length > 0" class="mt-6">
                <div class="flex items-center justify-end mb-4">
                    <div class="text-sm text-gray-700">
                        Showing
                        <span class="font-semibold">{{ products.from?.toLocaleString() }}</span>
                        to
                        <span class="font-semibold">{{ products.to?.toLocaleString() }}</span>
                        of
                        <span class="font-semibold">{{ products.total?.toLocaleString() }}</span>
                        results
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <div v-if="products.links.length > 3" class="flex flex-wrap -mb-1">
                        <template v-for="(link, key) in products.links" :key="key">
                            <div v-if="link.url === null"
                                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                v-html="link.label" />

                            <Link v-else :href="link.url"
                                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-brand-yellow focus:border-brand-blue focus:text-brand-blue transition-all"
                                :class="{ 'bg-brand-blue text-white hover:bg-brand-blue': link.active }"
                                v-html="link.label" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
