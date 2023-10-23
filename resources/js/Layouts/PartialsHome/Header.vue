<script setup>
import HomeNavLink from '@/Components/HomeNavLink.vue';
import { router } from '@inertiajs/vue3';
import Icon from '@/Components/Icon.vue';

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <header>
        <nav class="bg-white fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600 h-20">
            <ul class="navigation container flex flex-wrap justify-between items-center relative mx-auto py-6">
                <a class="logo font-bold text-blue-700 invisible lg:visible" :href="route('home.welcome')">
                    PENERIMAAN PESERTA DIDIK BARU
                </a>
                <input type="checkbox" id="check" />

                <span class="menu flex [&>li]:pl-8 [&>li>a]:text-center [&>li>a]:relative [&>li>a]:transition [&>li>a]:duration-200 [&>li>a]:ease-in-out [&>li>a]:font-normal [&>li>a]:text-lg">
                    <li>
                        <HomeNavLink :href="route('home.welcome')" :active="route().current('home.welcome')">
                            Beranda
                        </HomeNavLink>
                    </li>
                    <template v-if="!$page.props?.auth?.user?.name">
                        <li>
                            <HomeNavLink :href="route('login')" :active="route().current('login')">
                                Masuk
                            </HomeNavLink>
                        </li>
                    </template>
                    <template v-if="$page.props.auth.user">
                        <li>
                            <HomeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dasbor
                            </HomeNavLink>
                        </li>
                        <li>
                            <HomeNavLink :href="route('userdata.create')" :active="route().current('userdata.create')">
                                Formulir
                            </HomeNavLink>
                        </li>
                        <li>
                            <HomeNavLink href="#" :active="route().current('login')">
                                <form @submit.prevent="logout">
                                    <button type="submit">
                                        Log Out
                                    </button>
                                </form>
                            </HomeNavLink>
                        </li>
                    </template>
                    <label for="check" class="close-menu"><Icon name="XCircle" /></label>
                </span>

                <label for="check" class="open-menu">
                    <Icon name="BarChart2" class="-rotate-90"/>
                </label>
            </ul>
        </nav>
    </header>
</template>