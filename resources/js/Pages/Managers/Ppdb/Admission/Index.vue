<script setup>
import ManagerLayout from '@/Layouts/ManagerLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import ModalDelete from '@/Components/ModalDelete.vue';
import Pagination from '@/Components/Pagination.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import IsActive from '@/Components/IsActive.vue';
import { Link } from '@inertiajs/vue3';
import { Dropdown } from 'flowbite-vue';

const props = defineProps({
	models: {
        type: Object,
        default: {},
    },
	attr: {
        type: Object,
        default: {},
    },
});

</script>

<template>
    <ManagerLayout :title="attr?.title" :key="12">
        <template #header>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6 xl:col-span-9 intro-y">
                    <Breadcrumb :breadcrumb="attr?.breadcrumb"/>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y text-right">
                    <ButtonLink button_name="danger" :href="attr?.add_link" >Tambah</ButtonLink>
                </div>
            </div>
        </template>

        <div class="">
            <div class="max-w-full overflow-x-auto mx-auto pb-48">
                <div class="relative mt-7">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">Tahun</th>
                                <th scope="col" class="px-6 py-3 text-center">Gelombang</th>
                                <th scope="col" class="px-6 py-3 text-center">Kuota</th>
                                <th scope="col" class="px-6 py-3 text-center">Rentang Waktu</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="(item, index) in models.data" :key="index" >
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.year }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.stage }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.quota }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.startDateAt }} <span class="text-red-500">sampai</span> {{ item?.endDateAt }}</th>
                                <th scope="row" class="px-6 py-4 border text-center"><IsActive :is_active="item?.is_active" /></th>
                                <td class="px-6 py-4 text-center border whitespace-nowrap">
                                    <div class="flex justify-center items-center">                                        
                                        <Link :href="route(attr?.route_name + 'edit', item?.id)" class="flex items-center mr-3">
                                            Edit 
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-7">
                        <Pagination :links="models.links" />
                    </div>
                </div>
            </div>
        </div>
    </ManagerLayout>
</template>
