<script setup>
import ManagerLayout from '@/Layouts/ManagerLayout.vue';
import { ref } from 'vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';

const iframe_load = ref(false);

const props = defineProps({
	attr: {
        type: Object,
        default: {},
    },
});

function onloadPage() {
	iframe_load.value = true;
}

</script>

<template>
    <ManagerLayout :title="attr?.title" :key="12">
        <template #header>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6 xl:col-span-9 intro-y">
                    <Breadcrumb :breadcrumb="attr?.breadcrumb"/>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y text-right">
                    
                </div>
            </div>
        </template>

        <div class="">
            <div class="max-w-full overflow-x-auto mx-auto pb-48">
                <div class="relative mt-7" v-show="iframe_load">
                    <iframe 
                        :src="attr?.register_pdf_url" 
                        frameborder="0"
                        class="w-full min-h-fit"
                        style="min-height: 700px"
                        @load="onloadPage()"
                        :key="attr?.url"
                    />
                </div>
            </div>
        </div>
    </ManagerLayout>
</template>
