<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        default: '/',
    },
	button_name: {
        type: String,
        default: 'primary',
    },
});

const button_name_style = computed(() => {
	let className = "inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 transition ease-in-out duration-150";
	if(props.button_name == 'primary') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 transition ease-in-out duration-150"; 
	} else if(props.button_name == 'secondary') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-neutral-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-500 active:bg-neutral-700 transition ease-in-out duration-150"; 
	} else if(props.button_name == 'success') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 transition ease-in-out duration-150"; 
	} else if(props.button_name == 'warning') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 transition ease-in-out duration-150";
	} else if(props.button_name == 'danger') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 transition ease-in-out duration-150"; 
	}

	return className;
});
</script>

<template>
	<a :href="href" :class="button_name_style" ><slot /></a>
</template>
