<script setup>
import { onMounted, ref } from 'vue';

import HomeLayout from '@/Layouts/HomeLayout.vue';

const props = defineProps({
	attr: {
        type: Object,
        default: {},
    },
});


onMounted(() => {
    //
});

</script>

<template>
    <HomeLayout :title="`Welcome`" >
        <section class="text-gray-600 body-font bg-gray-50">
            <div class="container px-5 py-24 mx-auto">
                <div class="p-20">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                            <h2 class="text-2xl font-bold mb-2 text-gray-800">SELAMAT PENDAFTARAN BERHASIL</h2>
                            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Hai!,{{ attr?.user?.name }}</p>
                            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">NO Pendaftaran : {{ attr?.user?.register_form?.register_number }}</p>
                        </div>

                        <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                            <h1 class="sm:text-2xl text-2xl font-medium title-font mb-2 text-blue-700">"AKUN ANDA BERHASIL DIBUAT"</h1>
                            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">silahkan login dengan menggunakan</p>
                            <p class="lg:w-1/2 w-full leading-relaxed text-gray-900">Username : {{ attr?.user?.email }}</p>
                            <p class="lg:w-1/2 w-full leading-relaxed text-gray-900">Password : {{ attr?.register?.password }}</p>
                            <p class="lg:w-1/2 w-full leading-relaxed text-red-500">*MOHON DIINGAT JIKA PERLU SCREENSHOT</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
