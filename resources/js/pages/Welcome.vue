<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                        Log in
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main
                class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row shadow-xl">
                <div
                    class="flex-1 rounded-bl-lg rounded-br-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] lg:rounded-br-none lg:rounded-tl-lg lg:p-20">
                    <h1 class="mb-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $page.props.name }}</h1>
                    <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A]">
                        Efficiently manage your inventory, track stock levels, and organize categories all in one place.
                    </p>

                    <ul class="mb-8 flex flex-col lg:mb-10">
                        <li class="relative flex items-center gap-4 py-3">
                            <span class="relative bg-white py-1 dark:bg-[#161615] z-10">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full border border-yellow-200 bg-yellow-50 dark:border-yellow-900 dark:bg-yellow-900/30">
                                    <span class="h-2 w-2 rounded-full bg-brand-yellow" />
                                </span>
                            </span>
                            <span class="text-sm">
                                Monitor <span class="font-semibold text-brand-blue">Inventory Levels</span> and receive
                                low-stock alerts.
                            </span>
                        </li>

                        <li class="relative flex items-center gap-4 py-3">
                            <span class="relative bg-white py-1 dark:bg-[#161615] z-10">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full border border-yellow-200 bg-yellow-50 dark:border-yellow-900 dark:bg-yellow-900/30">
                                    <span class="h-2 w-2 rounded-full bg-brand-yellow" />
                                </span>
                            </span>
                            <span class="text-sm">
                                Organize products into <span class="font-semibold text-brand-blue">Dynamic
                                    Categories</span>.
                            </span>
                        </li>
                    </ul>

                    <div class="flex flex-wrap gap-4">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md bg-brand-blue px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">
                            Go to Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md bg-brand-blue px-8 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition-all">
                                Log in
                            </Link>
                        </template>
                    </div>
                </div>

                <div
                    class="relative -mb-px aspect-[335/376] w-full shrink-0 overflow-hidden rounded-t-lg bg-blue-50 dark:bg-slate-900 lg:-ml-px lg:mb-0 lg:aspect-auto lg:w-[400px] lg:rounded-r-lg lg:rounded-t-none flex items-center justify-center">
                    <div class="absolute inset-0 opacity-10"
                        :style="{ backgroundImage: 'radial-gradient(#3b82f6 1px, transparent 1px)', backgroundSize: '20px 20px' }">
                    </div>

                    <div class="relative z-10 flex flex-col items-center">
                        <div
                            class="p-5 rounded-2xl bg-white shadow-2xl dark:bg-slate-800 border border-blue-100 dark:border-slate-700">
                            <svg class="w-20 h-20 text-brand-yellow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="mt-4 text-center">
                            <span
                                class="text-xs uppercase tracking-[0.2em] font-bold text-yellow-600/60 dark:text-yellow-400/60">
                                App version 1.0
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>
