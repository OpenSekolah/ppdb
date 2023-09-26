<script setup>
    import {  Link } from '@inertiajs/vue3';
    
    const props = defineProps({
        links: Array,
    });

    function isActive(link) {
        return (link.active === true) ? 'active' : 'normal';
    }

    function handleNoLink() {
        return false;
    }
</script>

<template>
    <div v-if="links.length > 3">
        <div class="container flex justify-center mx-auto my-6 ">
            <template class="flex" v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>
