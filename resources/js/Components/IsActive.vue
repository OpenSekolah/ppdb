<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    is_active: Number,
});

</script>

<template>
<span v-if="is_active" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aktif</span>
<span v-else class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Tidak Aktif</span>
</template>
