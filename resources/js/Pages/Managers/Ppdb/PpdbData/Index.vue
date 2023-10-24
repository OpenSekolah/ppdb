<script setup>
import ManagerLayout from '@/Layouts/ManagerLayout.vue';
import { reactive } from 'vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Pagination from '@/Components/Pagination.vue';
import RegisterStatus from '@/Components/RegisterStatus.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import Button from '@/Components/Button.vue';
import { Link, router } from '@inertiajs/vue3';

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

const filters = reactive({
  search: props?.attr?.search,
  admid: props?.attr?.admid,
});

const getFilters = () => {
    router.get(route(`${props?.attr?.route_name}index`, filters));
};

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
                <div class="relative mt-7">
                    <div class="mb-7">
                        <form @submit.prevent="getFilters" >
                            <Select v-model="filters.admid" :options="attr?.admissions" class="mr-3"/>
                            <TextInput v-model="filters.search" placeholder="nama, nisn, no pendaftaran" class="mr-3"/>
                            <Button>
                                Cari
                            </Button>
                        </form>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">Nomor Pendaftaran</th>
                                <th scope="col" class="px-6 py-3 text-center">Tahun</th>
                                <th scope="col" class="px-6 py-3 text-center">Gelombang</th>
                                <th scope="col" class="px-6 py-3 text-center">Kuota</th>
                                <th scope="col" class="px-6 py-3 text-center">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3 text-center">NISN</th>
                                <th scope="col" class="px-6 py-3 text-center">Berkas</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="(item, index) in models.data" :key="index" >
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.register_number  }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.admission?.year  }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.admission?.stage  }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.admission?.quota  }}</th>
                                <th scope="row" class="px-6 py-4 border">{{ item?.name }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.nisn }}</th>
                                <th scope="row" class="px-6 py-4 border text-center">{{ item?.docStatusAt  }}</th>
                                <th scope="row" class="px-6 py-4 border text-center"><RegisterStatus :status="item?.status"/></th>
                                <td class="px-6 py-4 text-center border whitespace-nowrap">
                                    <div class="flex justify-center items-center">                                        
                                        <Link :href="route(attr?.route_name + 'edit', item?.id)" class="flex items-center mr-3" >
                                            Edit 
                                        </Link>
                                        <Link :href="route(attr?.route_name + 'show', item?.id)" class="flex items-center mr-3 text-red-500" >
                                            Formulir 
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
