<script setup>
import { ref } from 'vue';
import ManagerLayout from '@/Layouts/ManagerLayout.vue';

const props = defineProps({
	attr: {
        type: Object,
        default: {},
    },
});

</script>

<template>
    <ManagerLayout :title="attributes?.title" :key="12">
        
    </ManagerLayout>
</template>
