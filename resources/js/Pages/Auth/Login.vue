<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Avatar } from 'flowbite-vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="flex items-center min-h-screen p-4 bg-gray-100 lg:justify-center">
        <div
            class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md"
        >
            <div
                class="p-4 py-6 text-white bg-blue-500 md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly"
            >
                <div class="my-3 text-4xl font-bold tracking-wider text-center">
                    <a :href="route('home.welcome')">
                        <AuthenticationCardLogo class="text-white" />
                    </a>
                </div>
                <p class="mt-6 font-normal text-center text-gray-300 md:mt-0">
                    <h1 class="text-white bold">Info Lebih Lanjut</h1>
                    <ul class="list-disc mt-4 text-xs text-white">
                        <li>Bapak ABC : +62XXXXXXXXXXX</li>
                        <li>WA Center : +62XXXXXXXXXXX</li>
                    </ul> 
                </p>
                <p class="flex flex-col items-center justify-center mt-10 text-center">
                    <span>Belum punya akun?</span>
                    <a :href="route('home.welcome')" class="underline">Daftar</a>
                </p>
            </div>

            <div class="p-5 bg-white md:flex-1">
                <h3 class="my-4 text-2xl font-semibold text-gray-700 uppercase">Masuk</h3>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="NINS" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Forgot your password?
                        </Link>

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>

                    <ul class="list-disc mt-7 italic text-xs text-red-700">
                        <li>Masukan Username dan password yang sudah dibuat</li>
                        <li>Apabila belum mendapat Username dan Password silahkan hubungi panitia</li>
                    </ul> 
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    body {
        padding-top: 0px !important;
    }
</style>