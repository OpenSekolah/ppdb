<script setup>
import ManagerLayout from '@/Layouts/ManagerLayout.vue';

import { useForm } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Button from '@/Components/Button.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Select from '@/Components/Select.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps({
	model: {
        type: Object,
        default: {},
    },
	attr: {
        type: Object,
        default: {},
    },
});

const form = useForm({
    _method: props?.attr?.form_type,
    name: props?.model?.name,
    nisn: props?.model?.nisn,
    place_of_birth: props?.model?.place_of_birth,
    date_of_birth: props?.model?.date_of_birth,
    address: props?.model?.address,
    from_school: props?.model?.from_school,
    competence_first: props?.model?.competence_first,
    competence_second: props?.model?.competence_second,
    status: props?.model?.status,
});

const createModel = () => {
    form.post(props?.attr?.route_url, {
        preserveScroll: true,
        onSuccess: () => {
            
        },
    });
};
</script>

<template>
    <ManagerLayout :title="attr?.title">
        <template #header>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6 xl:col-span-9 intro-y">
                    <Breadcrumb :breadcrumb="attr?.breadcrumb"/>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y text-right">
                   
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                    <template #title>
                        {{ attr?.title }}
                    </template>

                    <template #description>
                        {{ attr?.title }} 
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="year" value="Tahun" />
                                    <TextInput
                                        id="year"
                                        type="text"
                                        class="mt-1 block w-full"
                                        :disabled="true"
                                        :value="model?.admission?.year"
                                    />
                                </div>
                                <div>
                                    <InputLabel for="stage" value="Gelombang" />
                                    <TextInput
                                        id="stage"
                                        type="text"
                                        class="mt-1 block w-full"
                                        :disabled="true"
                                        :value="model?.admission?.stage"
                                    />
                                    <InputError :message="form.errors.nisn" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="name" value="Nama Lengkap" />
                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        autofocus
                                    />
                                    <InputError :message="form.errors.name" class="mt-2" />
                                </div>
                                <div>
                                    <InputLabel for="nisn" value="NISN" />
                                    <TextInput
                                        id="nisn"
                                        v-model="form.nisn"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <InputError :message="form.errors.nisn" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel for="place_of_birth" value="Tempat Lahir" />
                                        <TextInput
                                            id="place_of_birth"
                                            v-model="form.place_of_birth"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError :message="form.errors.place_of_birth" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                    <VueDatePicker 
                                        id="date_of_birth"
                                        v-model="form.date_of_birth"
                                        class="mt-1 block w-full"
                                        format="dd/MM/yyyy"
                                    >
                                    </VueDatePicker>
                                    <InputError :message="form.errors.date_of_birth" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="address" value="Alamat" />
                            <TextArea
                                id="address"
                                v-model="form.address"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="from_school" value="Asal Sekolah" />
                            <TextInput
                                id="from_school"
                                v-model="form.from_school"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.from_school" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="competence_first" value="Pilihan Jurusan 1" />
                                    <Select
                                        id="competence_first"
                                        v-model="form.competence_first"
                                        class="mt-1 block w-full"
                                        :options="attr?.competences"
                                    />
                                    <InputError class="mt-2" :message="form.errors.competence_first" />
                                </div>

                                <div>
                                    <InputLabel for="competence_second" value="Pilihan Jurusan 2" />
                                    <Select
                                        id="competence_second"
                                        v-model="form.competence_second"
                                        class="mt-1 block w-full"
                                        :options="attr?.competences"
                                    />
                                    <InputError class="mt-2" :message="form.errors.competence_second" />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="status" value="Status" />
                            <Select
                                id="status"
                                v-model="form.status"
                                class="mt-1 block w-full"
                                :options="attr?.statuses"
                            />
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </ActionMessage>

                        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Simpan
                        </Button>
                    </template>
                </FormSection>
            </div>
        </div>
    </ManagerLayout>
</template>
