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
    })).post(route('manager.login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />
    <!-- bg-cover bg-no-repeat style="background-image: url('https://images2.alphacoders.com/130/1308322.jpeg') !important;" -->
    <div class="flex items-center min-h-screen p-4 lg:justify-center" >
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
                    <h1 class="text-white bold">Portal Admin</h1>
                </p>
            </div>

            <div class="p-5 bg-white md:flex-1">
                <h3 class="my-4 text-2xl font-semibold text-gray-700 uppercase">Masuk</h3>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
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
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    body {
        padding-top: 0px !important;
        background: -moz-linear-gradient(45deg, #02e1ba 0%, #26c9f2 29%, #d911f2 66%, #ffa079 100%);
        background: -webkit-linear-gradient(45deg, #02e1ba 0%,#26c9f2 29%,#d911f2 66%,#ffa079 100%);
        background: linear-gradient(45deg, #02e1ba 0%,#26c9f2 29%,#d911f2 66%,#ffa079 100%);
        background-size: 400% 400%;
        -webkit-animation: Gradient 15s ease infinite;
        -moz-animation: Gradient 15s ease infinite;
        animation: Gradient 15s ease infinite;
        /*min-height: calc(100vh - 2rem);*/
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: space-evenly;
        overflow: hidden;
        position: relative; 
    }

    body::before, 
    body::after {
        content: "";
        width: 70vmax;
        height: 70vmax;
        position: absolute;
        background: rgba(255, 255, 255, 0.07);
        left: -20vmin;
        top: -20vmin;
        animation: morph 15s linear infinite alternate, spin 20s linear infinite;
        z-index: 1;
        will-change: border-radius, transform;
        transform-origin: 55% 55%;
        pointer-events: none; 
    }
        
    body::after {
        width: 70vmin;
        height: 70vmin;
        left: auto;
        right: -10vmin;
        top: auto;
        bottom: 0;
        animation: morph 10s linear infinite alternate, spin 26s linear infinite reverse;
        transform-origin: 20% 20%; 
    }

    @-webkit-keyframes Gradient {
        0% {
            background-position: 0 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0 50%
        }
    }

    @-moz-keyframes Gradient {
        0% {
            background-position: 0 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0 50%
        }
    }

    @keyframes Gradient {
        0% {
            background-position: 0 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0 50%
        }
    }

    @keyframes morph {
    0% {
        border-radius: 40% 60% 60% 40% / 70% 30% 70% 30%; }
    100% {
        border-radius: 40% 60%; } 
    }

    @keyframes spin {
    to {
        transform: rotate(1turn); 
    } 
    }
        .st0{display:none;}
        .st1{display:inline;}
        .st2{opacity:0.29;}
        .st3{fill:#FFFFFF;}
        .st4{clip-path:url(#SVGID_2_);fill:#FFFFFF;}
        .st5{clip-path:url(#SVGID_4_);}
        .st6{clip-path:url(#SVGID_6_);}
        .st7{clip-path:url(#SVGID_8_);}
        .st8{clip-path:url(#SVGID_10_);}
        .st9{fill:none;}
        .st10{clip-path:url(#SVGID_12_);}
        .st11{opacity:0.7;}
        .st12{clip-path:url(#SVGID_14_);}
        .st13{opacity:0.2;}
        .st14{clip-path:url(#SVGID_16_);}
        .st15{opacity:0.3;fill:#FFFFFF;enable-background:new    ;}
</style>