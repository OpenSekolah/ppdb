<script setup>
const props = defineProps({
    status: String,
});

</script>

<template>
<span v-if="status == 'verified'" style="font-family: sans-serif;" class="text-orange-800">Diverifikasi</span>
<span v-if="status == 'accepted'" style="font-family: sans-serif;" class="text-green-800">Diterima</span>
<span v-if="status == 'reserved'" style="font-family: sans-serif;" class="text-red-800">Dicadangkan</span>
</template>
