<script setup>
import { computed } from 'vue';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'text-blue-700 hover:text-blue-800'
        : 'hover:text-blue-800';
});
</script>

<template>
    <a :href="href" :class="classes">
        <slot />
    </a>
</template>
