<script setup>
import { onMounted } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import HeaderHome from './PartialsHome/Header.vue';
import FooterHome from './PartialsHome/Footer.vue';

defineProps({
    title: String,
});

onMounted(() => {
	if(usePage().props?.flash?.success !== null && usePage().props?.flash?.success !== undefined) {
		ToastAlert.fire({
			position: 'top-end',
			icon: 'success',
			toast: true,
			title: usePage().props?.flash?.success
		});
	}
	
	if(usePage().props?.flash?.warnings !== null && usePage().props?.flash?.warnings !== undefined) {
		ToastAlert.fire({
			position: 'top-end',
			icon: 'error',
			toast: true,
			title: usePage().props?.flash?.warnings
		});
	}
});
</script>

<template>
    <Head :title="title" />
    
    <HeaderHome :title="title" />
    <slot />

    <FooterHome />

</template>
