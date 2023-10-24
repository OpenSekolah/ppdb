<script setup>
const props = defineProps({
    status: String,
});

</script>

<template>
<span v-if="status == 'verified'" class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">Diverifikasi</span>
<span v-if="status == 'accepted'" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Diterima</span>
<span v-if="status == 'reserved'" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Dicadangkan</span>
</template>
