<script setup>
defineProps({
    title: String,
});
</script>

<template>
    <header class="text-gray-700 body-font border-b border-gray-200">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" :href="route('home.welcome')" >
                <img src="@/Images/logo.svg" class="w-10 h-10 rounded-full" /> 
                <span class="ml-3 text-xl">PPDB</span>
            </a>
        </div>
    </header>
</template>