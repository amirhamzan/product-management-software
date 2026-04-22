<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div class="flex min-h-screen items-center justify-center bg-[#FDFDFC] p-6 dark:bg-[#0A0A0A]">
        <main
            class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg shadow-2xl lg:max-w-4xl lg:flex-row">

            <div
                class="flex-1 bg-white p-8 dark:bg-[#161615] lg:p-16 lg:rounded-l-lg border-y border-l dark:border-[#262624]">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome Back</h1>
                    <p class="text-sm text-gray-500 dark:text-[#A1A09A]">Please enter your details to access your
                        inventory.</p>
                </div>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="grid gap-5">
                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input id="email" type="email" required autofocus tabindex="1" v-model="form.email"
                            placeholder="admin@example.com" class="focus:ring-brand-blue" />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between">
                            <Label for="password">Password</Label>
                        </div>
                        <Input id="password" type="password" required tabindex="2" v-model="form.password"
                            placeholder="••••••••" class="focus:ring-brand-blue" />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <Label for="remember" class="flex items-center space-x-2 cursor-pointer">
                            <Checkbox id="remember" v-model:checked="form.remember" tabindex="3" />
                            <span class="text-xs">Remember me</span>
                        </Label>
                    </div>

                    <Button type="submit" class="w-full bg-brand-blue hover:bg-blue-700 text-white py-6" tabindex="4"
                        :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
                        Log in
                    </Button>

                    <div class="text-center text-xs text-gray-500 mt-2">
                        Looking for the homepage?
                        <TextLink :href="route('home')" class="text-brand-blue font-semibold">Return to welcome
                        </TextLink>
                    </div>
                </form>
            </div>

            <div
                class="relative hidden lg:flex aspect-auto w-[400px] flex-col items-center justify-center bg-blue-50 dark:bg-[#1D0002]/20 lg:rounded-r-lg border-y border-r dark:border-[#262624]">
                <div class="absolute inset-0 opacity-10"
                    :style="{ backgroundImage: 'radial-gradient(#3b82f6 1px, transparent 1px)', backgroundSize: '20px 20px' }">
                </div>

                <div class="relative z-10 flex flex-col items-center px-12 text-center">
                    <div
                        class="mb-6 p-5 rounded-2xl bg-white shadow-xl dark:bg-slate-800 border border-blue-100 dark:border-slate-700">
                        <svg class="w-16 h-16 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Secure Access</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Your inventory data is encrypted and protected with industry-standard security.
                    </p>
                </div>
            </div>
        </main>
    </div>
</template>
