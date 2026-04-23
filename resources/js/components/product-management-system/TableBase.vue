<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { FolderOpen } from 'lucide-vue-next';

defineProps<{
    headers: any[]; // Changed to any[] to allow for objects if you want to handle sorting later
    items: any[];
    pagination?: {
        links: any[];
        from: number;
        to: number;
        total: number;
    };
    emptyText?: string;
}>();
</script>

<template>
    <div class="flex flex-col gap-4">
        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-[#262624] dark:bg-[#161615]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-[#1C1C1B]">
                        <tr>
                            <slot name="header-cells">
                                <th v-for="header in headers" :key="header"
                                    class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 whitespace-nowrap">
                                    {{ header }}
                                </th>
                            </slot>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-[#262624]">
                        <slot name="rows" />

                        <tr v-if="items.length === 0">
                            <td :colspan="headers.length" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center text-muted-foreground">
                                    <FolderOpen class="mb-2 h-8 w-8 opacity-20" />
                                    <p>{{ emptyText || 'No data found' }}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="pagination && items.length > 0"
            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between px-2">
            <div class="text-sm text-gray-500">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ pagination.from?.toLocaleString() }}</span>
                to
                <span class="font-semibold text-gray-900 dark:text-white">{{ pagination.to?.toLocaleString() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ pagination.total?.toLocaleString()
                    }}</span> results
            </div>

            <nav v-if="pagination.links.length > 3" class="flex items-center gap-1">
                <template v-for="(link, key) in pagination.links" :key="key">
                    <div v-if="link.url === null"
                        class="px-3 py-2 text-xs text-gray-400 border border-gray-200 rounded-md dark:border-[#262624] opacity-50"
                        v-html="link.label" />

                    <Link v-else :href="link.url"
                        class="px-3 py-2 text-xs font-medium border border-gray-200 rounded-md transition-all dark:border-[#262624]"
                        :class="{
                            'bg-brand-blue text-white border-brand-blue shadow-sm': link.active,
                            'bg-white text-gray-700 hover:bg-gray-50 dark:bg-[#161615] dark:text-gray-300 dark:hover:bg-[#1C1C1B]': !link.active
                        }" v-html="link.label" />
                </template>
            </nav>
        </div>
    </div>
</template>