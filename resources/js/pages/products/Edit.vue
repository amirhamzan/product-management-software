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
        title: 'Edit Product',
        href: '/products/show',
    },
];


const page = usePage();

const product = computed(() => page.props.product);
const categories = computed(() => page.props.categories);

const form = useForm({
    name: product.value.name,
    category_id: product.value.category_id,
    quantity: product.value.quantity,
});

const submitForm = () => {
    form.put(route('products.update', product.value), {
        onError: (errors) => {
            console.log("Validation failed:", errors);
        },
        onSuccess: () => form.reset(),
    });
};
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
                <form @submit.prevent="submitForm">
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
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
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Category
                                Name</label>
                            <div class="mt-2">
                                <select required id="category_id" v-model="form.category_id" class="">
                                    <option disabled value="">Please select category</option>
                                    <option v-for="category in categories" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.category_id }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-900/10 mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
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
                    <div class="mt-4 flex justify-between items-center">
                        <Button class="mt-4" variant="default">
                            <button>Submit</button>
                        </Button>
                        <Link :href="route('products.show', product)">
                            <Button variant="destructive">
                                <button>Cancel update</button>
                            </Button>
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
