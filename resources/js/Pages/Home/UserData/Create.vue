<script setup>
import { onMounted, ref } from 'vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Tabs, Tab } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3';
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
import { alertMessage } from '@/Utils/global.js';

const activeTab = ref('register');

const props = defineProps({
	register_model: {
        type: Object,
        default: {},
    },
	attr: {
        type: Object,
        default: {},
    },
});

const register = useForm({
    _method: 'POST',
    type: 'register',
    name: props?.register_model?.name,
    nisn: props?.register_model?.nisn,
    place_of_birth: props?.register_model?.place_of_birth,
    date_of_birth: props?.register_model?.date_of_birth,
    address: props?.register_model?.address,
    from_school: props?.register_model?.from_school,
    competence_first: props?.register_model?.competence_first,
    competence_second: props?.register_model?.competence_second,
    status: props?.register_model?.status,
});

const createModel = () => {
    if(activeTab.value == 'register') {
        register.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    }
    
};

onMounted(() => {
    //
});

</script>

<template>
    <HomeLayout :title="`Welcome`" >
        <section class="text-gray-600 body-font bg-gray-50">
            <div class="container px-5 py-7 mx-auto">
                <tabs variant="underline" v-model="activeTab" class="py-5"> <!-- class appends to content DIV for all tabs -->
                    <tab name="register" :title="attr?.title_profile">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_profile }}
                            </template>

                            <template #description>
                                {{ attr?.title_profile_desc }} 
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
                                                :value="register_model?.admission?.year"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel for="stage" value="Gelombang" />
                                            <TextInput
                                                id="stage"
                                                type="text"
                                                class="mt-1 block w-full"
                                                :disabled="true"
                                                :value="register_model?.admission?.stage"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                        <div>
                                            <InputLabel for="name" value="Nama Lengkap" />
                                            <TextInput
                                                id="name"
                                                v-model="register.name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                autofocus
                                            />
                                            <InputError :message="register.errors.name" class="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel for="nisn" value="NISN" />
                                            <TextInput
                                                id="nisn"
                                                v-model="register.nisn"
                                                type="text"
                                                class="mt-1 block w-full"
                                                :disabled="true"
                                            />
                                            <InputError :message="register.errors.nisn" class="mt-2" />
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
                                                    v-model="register.place_of_birth"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError :message="register.errors.place_of_birth" class="mt-2" />
                                            </div>
                                        </div>
                                        <div>
                                            <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                            <VueDatePicker 
                                                id="date_of_birth"
                                                v-model="register.date_of_birth"
                                                class="mt-1 block w-full"
                                                format="dd/MM/yyyy"
                                            >
                                            </VueDatePicker>
                                            <InputError :message="register.errors.date_of_birth" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="address" value="Alamat" />
                                    <TextArea
                                        id="address"
                                        v-model="register.address"
                                        class="mt-1 block w-full"
                                    />
                                    <InputError class="mt-2" :message="register.errors.address" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="from_school" value="Asal Sekolah" />
                                    <TextInput
                                        id="from_school"
                                        v-model="register.from_school"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <InputError class="mt-2" :message="register.errors.from_school" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                        <div>
                                            <InputLabel for="competence_first" value="Pilihan Jurusan 1" />
                                            <Select
                                                id="competence_first"
                                                v-model="register.competence_first"
                                                class="mt-1 block w-full"
                                                :options="attr?.competences"
                                            />
                                            <InputError class="mt-2" :message="register.errors.competence_first" />
                                        </div>

                                        <div>
                                            <InputLabel for="competence_second" value="Pilihan Jurusan 2" />
                                            <Select
                                                id="competence_second"
                                                v-model="register.competence_second"
                                                class="mt-1 block w-full"
                                                :options="attr?.competences"
                                            />
                                            <InputError class="mt-2" :message="register.errors.competence_second" />
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="register.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': register.processing }" :disabled="register.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                    <tab name="address" title="Data Alamat">
                        Lorem...
                    </tab>
                    <tab name="parent" title="Orang tua">
                        Lorem...
                    </tab>
                    <tab name="file" title="Upload Foto">
                        Lorem...
                    </tab>
                </tabs>
            </div>
        </section>
    </HomeLayout>
</template>
