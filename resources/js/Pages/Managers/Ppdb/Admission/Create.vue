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
    year: props?.model?.year,
    stage: props?.model?.stage,
    quota: props?.model?.quota,
    start_date: props?.model?.start_date,
    end_date: props?.model?.end_date,
    is_active: props?.model?.is_active ?? 0
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
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
                                <div>
                                    <InputLabel for="year" value="Tahun" />
                                    <TextInput
                                        id="year"
                                        v-model="form.year"
                                        type="text"
                                        class="mt-1 block w-full"
                                        autofocus
                                    />
                                    <InputError :message="form.errors.year" class="mt-2" />
                                </div>
                                <div>
                                    <InputLabel for="stage" value="Gelombang" />
                                    <TextInput
                                        id="stage"
                                        v-model="form.stage"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <InputError :message="form.errors.stage" class="mt-2" />
                                </div>
                                <div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel for="quota" value="Kuota Penerimaan Siswa" />
                                        <TextInput
                                            id="quota"
                                            v-model="form.quota"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError :message="form.errors.quota" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="start_date" value="Mulai Tanggal" />
                                    <VueDatePicker 
                                        id="start_date"
                                        v-model="form.start_date"
                                        class="mt-1 block w-full"
                                        format="dd/MM/yyyy"
                                    >
                                    </VueDatePicker>
                                    <InputError :message="form.errors.start_date" class="mt-2" />
                                </div>
                                <div>
                                    <InputLabel for="end_date" value="Berakhir Tanggal" />
                                    <VueDatePicker 
                                        id="end_date"
                                        v-model="form.end_date"
                                        class="mt-1 block w-full"
                                        format="dd/MM/yyyy"
                                    >
                                    </VueDatePicker>
                                    <InputError :message="form.errors.end_date" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="is_active" value="Status" />
                            <Select
                                id="is_active"
                                v-model="form.is_active"
                                class="mt-1 block w-full"
                                :options="attr?.statuses"
                            />
                            <InputError :message="form.errors.is_active" class="mt-2" />
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
