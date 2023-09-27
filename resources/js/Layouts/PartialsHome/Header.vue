<script setup>
import HomeNavLink from '@/Components/HomeNavLink.vue';
defineProps({
    title: String,
});
</script>

<template>
    <header>
        <nav class="bg-white fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600 h-20">
            <ul class="navigation container flex flex-wrap justify-between items-center relative mx-auto py-6">
                <a class="logo font-bold text-blue-700" :href="route('home.welcome')">
                    PENERIMAAN PESERTA DIDIK BARU
                </a>
                <input type="checkbox" id="check" />

                <span class="menu flex [&>li]:pl-8 [&>li>a]:text-center [&>li>a]:relative [&>li>a]:transition [&>li>a]:duration-200 [&>li>a]:ease-in-out [&>li>a]:font-medium [&>li>a]:text-lg">
                    <li>
                        <HomeNavLink :href="route('home.welcome')" :active="route().current('home.welcome')">
                            Beranda
                        </HomeNavLink>
                    </li>
                    <li>
                        <HomeNavLink :href="route('login')" :active="route().current('login')">
                            Login
                        </HomeNavLink>
                    </li>

                    <label for="check" class="close-menu">X</label>
                </span>

                <label for="check" class="open-menu">Menu</label>
            </ul>
        </nav>
    </header>
</template>