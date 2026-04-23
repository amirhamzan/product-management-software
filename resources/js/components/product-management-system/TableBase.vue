<script setup lang="ts">
import { FolderOpen } from 'lucide-vue-next';

defineProps<{
    headers: string[];
    items: any[];
    emptyText?: string;
}>();
</script>

<template>
    <div
        class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-[#262624] dark:bg-[#161615]">
        <div class="overflow-x-auto">
            <table class="overflow-x-auto w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-[#1C1C1B]">
                    <tr>
                        <th v-for="header in headers" :key="header"
                            class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 whitespace-nowrap">
                            {{ header }}
                        </th>
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
</template>