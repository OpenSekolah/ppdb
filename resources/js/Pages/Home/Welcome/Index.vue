<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
	attributes: {
        type: Object,
        default: {},
    },
	models: {
        type: Object,
        default: {},
    },
});

</script>

<template>
    <HomeLayout :title="`Welcome`" >
        <section class="text-gray-700 body-font border-t border-gray-200">
            
        </section>
    </HomeLayout>
</template>
