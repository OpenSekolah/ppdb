<script setup>
import { computed } from 'vue';

const props = defineProps({
    type: {
        type: String,
        default: 'submit',
    },
	button_type: {
        type: String,
        default: 'primary',
    },
});

const button_type_style = computed(() => {
	let className = "inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 transition ease-in-out duration-150";
	if(props.button_type == 'primary') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 transition ease-in-out duration-150"; 
	} else if(props.button_type == 'secondary') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-neutral-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-500 active:bg-neutral-700 transition ease-in-out duration-150"; 
	} else if(props.button_type == 'success') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 transition ease-in-out duration-150"; 
	} else if(props.button_type == 'warning') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 transition ease-in-out duration-150";
	} else if(props.button_type == 'danger') {
		className = "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 transition ease-in-out duration-150"; 
	}

	return className;
});
</script>

<template>
    <button :type="type" :class="button_type_style">
        <slot />
    </button>
</template>
