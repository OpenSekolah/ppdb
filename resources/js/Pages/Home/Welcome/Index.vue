<script setup>
import { onMounted, ref } from 'vue';

import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Select from '@/Components/Select.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const background_image = ref();

const props = defineProps({
	attr: {
        type: Object,
        default: {},
    },
	models: {
        type: Object,
        default: {},
    },
});

const form = useForm({
    _method: "POST",
    name: '',
    email: '',
    place_of_birth: '',
    date_of_birth: '',
    address: '',
    from_school: '',
    competence_first: '',
    competence_second: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const createModel = () => {
    form.post(route('register_form.store'), {
        preserveScroll: true,
        onSuccess: () => {
            
        },
    });
};

onMounted(() => {
    background_image.value = `${usePage().props?.base_url}images/bg.jpg`;
});

</script>

<template>
    <HomeLayout :title="`Welcome`" >
        <div
            class="relative pt-16 pb-32 flex content-center items-center justify-center"
            style="min-height: 75vh;"
        >
            <div
                class="absolute top-0 w-full h-full bg-center bg-cover"
                :style="`background-image: url(${background_image});`"
            >
                <span
                    id="blackOverlay"
                    class="w-full h-full absolute opacity-75 bg-black"
                >
                </span>
            </div>

            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">
                            <h1 class="text-white font-semibold text-5xl">
                                Penerimaan Peserta Didik Baru SMK ABC
                            </h1>
                            <p class="mt-4 text-lg text-gray-300">
                                Situs ini dipersiapkan sebagai pusat informasi dan pengolahan seleksi data siswa peserta SMK ABC Tahun Pelajaran 2023/2024 secara online dan realtime.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
            class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
            style="height: 70px;"
            >
                <svg
                    class="absolute bottom-0 overflow-hidden"
                    xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none"
                    version="1.1"
                    viewBox="0 0 2560 100"
                    x="0"
                    y="0"
                >
                    <polygon
                    class="text-gray-300 fill-current"
                    points="2560 0 2560 100 0 100"
                    ></polygon>
                </svg>
            </div>
        </div>

        <section class="body-font bg-gray-300" >
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-blue-700">Formulir Pendaftaran</h1>
                    <form class="w-full" @submit.prevent="createModel">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            <div class="mt-4">
                                <InputLabel for="name" value="Nama Lengkap" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="NISN" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="place_of_birth" value="Tempat Lahir" />
                                <TextInput
                                    id="place_of_birth"
                                    v-model="form.place_of_birth"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.place_of_birth" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                <VueDatePicker 
                                    id="date_of_birth"
                                    v-model="form.date_of_birth"
                                    class="mt-1 block w-full"
                                    format="dd/MM/yyyy"
                                >
                                </VueDatePicker>
                                <InputError class="mt-2" :message="form.errors.date_of_birth" />
                            </div>                            
                        </div>

                        <div class="mt-4">
                            <InputLabel for="address" value="Alamat" />
                            <TextArea
                                id="address"
                                v-model="form.address"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="from_school" value="Asal Sekolah" />
                            <TextInput
                                id="from_school"
                                v-model="form.from_school"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.from_school" />
                        </div>     

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            <div class="mt-4">
                                <InputLabel for="competence_first" value="Pilihan Jurusan 1" />
                                <Select
                                    id="competence_first"
                                    v-model="form.competence_first"
                                    class="mt-1 block w-full"
                                    :options="attr?.competences"
                                />
                                <InputError class="mt-2" :message="form.errors.competence_first" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="competence_second" value="Pilihan Jurusan 2" />
                                <Select
                                    id="competence_second"
                                    v-model="form.competence_second"
                                    class="mt-1 block w-full"
                                    :options="attr?.competences"
                                />
                                <InputError class="mt-2" :message="form.errors.competence_second" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Kata Sandi" />
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Konfirmasi Sandi" />
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sudah terdaftar?
                            </Link>

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Daftar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                    <img class="object-cover object-center rounded" alt="hero" src="/images/plot.jpeg">
                </div>
            </div>
        </section>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-blue-700">Konsentrasi Keahlian</h1>
                    <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Konsentrasi Keahlian yang diselenggarakan di SMK ABB</p>
                </div>

                <div class="flex flex-wrap -m-4">
                    <div class="xl:w-1/3 md:w-1/2 p-4" v-for="(item, index) in attr?.competence" :key="index">
                        <div class="border border-gray-200 p-6 rounded-lg">
                            <h2 class="text-lg text-blue-700 font-medium title-font mb-2">{{ item?.name }}</h2>
                            <p class="leading-relaxed text-base">{{ item?.desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
            </section>
    </HomeLayout>
</template>
