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
import '@vuepic/vue-datepicker/dist/main.css';
import { alertMessage } from '@/Utils/global.js';

const activeTab = ref('register');

const props = defineProps({
	register_model: {
        type: Object,
        default: {},
    },
	address_model: {
        type: Object,
        default: {},
    },
	father_model: {
        type: Object,
        default: {},
    },
	mother_model: {
        type: Object,
        default: {},
    },
	guardian_model: {
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

const addresses = useForm({
    _method: 'POST',
    type: 'addresses',
    residence: props?.address_model?.residence,
    address: props?.register_model?.address,
    rt: props?.address_model?.rt,
    rw: props?.address_model?.rw,
    village: props?.address_model?.village,
    subdistrict: props?.address_model?.subdistrict,
    province: props?.address_model?.province,
    postal_code: props?.address_model?.postal_code,
    address_coordinates: props?.address_model?.address_coordinates,
    transportation: props?.address_model?.transportation,
    distance: props?.address_model?.distance,
    traveling_time: props?.address_model?.traveling_time,
});


const father = useForm({
    _method: 'POST',
    type: 'father',
    status: props?.father_model?.status,
    nik: props?.father_model?.nik,
    name: props?.father_model?.name,
    place_of_birth: props?.father_model?.place_of_birth,
    date_of_birth: props?.father_model?.date_of_birth,
    education: props?.father_model?.education,
    work: props?.father_model?.work,
    income: props?.father_model?.income,
    phone: props?.father_model?.phone
});

const mother = useForm({
    _method: 'POST',
    type: 'mother',
    status: props?.mother_model?.status,
    nik: props?.mother_model?.nik,
    name: props?.mother_model?.name,
    place_of_birth: props?.mother_model?.place_of_birth,
    date_of_birth: props?.mother_model?.date_of_birth,
    education: props?.mother_model?.education,
    work: props?.mother_model?.work,
    income: props?.mother_model?.income,
    phone: props?.mother_model?.phone
});

const guardian = useForm({
    _method: 'POST',
    type: 'guardian',
    status: "Masih Hidup",
    nik: props?.guardian_model?.nik,
    name: props?.guardian_model?.name,
    place_of_birth: props?.guardian_model?.place_of_birth,
    date_of_birth: props?.guardian_model?.date_of_birth,
    education: props?.guardian_model?.education,
    work: props?.guardian_model?.work,
    income: props?.guardian_model?.income,
    phone: props?.guardian_model?.phone
});

const createModel = () => {
    if(activeTab.value == 'register') {
        register.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    } else if(activeTab.value == 'address') {
        addresses.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                register.address = addresses.address;
                alertMessage();
            },
        });
    } else if(activeTab.value == 'father') {
        father.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    } else if(activeTab.value == 'mother') {
        mother.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    } else if(activeTab.value == 'guardian') {
        guardian.post(props?.attr?.route_url, {
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
    <HomeLayout :title="`Formulir`" >
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
                    <tab name="address" :title="attr?.title_address">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_address }}
                            </template>

                            <template #description>
                                {{ attr?.title_address_desc }} 
                            </template>

                            <template #form>

                                <div class="col-span-6 sm:col-span-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel for="residence" value="Status Tempat Tinggal" />
                                        <Select
                                            id="residence"
                                            v-model="addresses.residence"
                                            class="mt-1 block w-full"
                                            :options="attr?.residences"
                                        />
                                        <InputError :message="addresses.errors.residence" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="address" value="Alamat" />
                                        <TextArea
                                            id="address"
                                            v-model="addresses.address"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError class="mt-2" :message="addresses.errors.address" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="rt" value="RT" />
                                                <TextInput
                                                    id="rt"
                                                    v-model="addresses.rt"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    autofocus
                                                />
                                                <InputError :message="addresses.errors.rt" class="mt-2" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="rw" value="Rw" />
                                                <TextInput
                                                    id="rw"
                                                    v-model="addresses.rw"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError :message="addresses.errors.rw" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="village" value="Desa" />
                                                <TextInput
                                                    id="village"
                                                    v-model="addresses.village"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="addresses.errors.village" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="subdistrict" value="Kecamatan" />
                                                <TextInput
                                                    id="subdistrict"
                                                    v-model="addresses.subdistrict"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="addresses.errors.subdistrict" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="province" value="Provinsi" />
                                                <TextInput
                                                    id="province"
                                                    v-model="addresses.province"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="addresses.errors.province" />
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel for="postal_code" value="Kodepos" />
                                                <TextInput
                                                    id="postal_code"
                                                    v-model="addresses.postal_code"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="addresses.errors.postal_code" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="address_coordinates" value="Koordinat Alamat" />
                                        <TextInput
                                            id="address_coordinates"
                                            v-model="addresses.address_coordinates"
                                            type="text"
                                            class="mt-1 block w-full"
                                            placeholder="Contoh penulisan : -7.9235494,110.3090862"
                                        />
                                        <InputError class="mt-2" :message="addresses.errors.address_coordinates" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="transportation" value="Transportasi" />
                                        <Select
                                            id="transportation"
                                            v-model="addresses.transportation"
                                            class="mt-1 block w-full"
                                            :options="attr?.transportations"
                                        />
                                        <InputError class="mt-2" :message="addresses.errors.transportation" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="distance" value="Jarak dari rumah ke sekolah" />
                                        <Select
                                            id="distance"
                                            v-model="addresses.distance"
                                            class="mt-1 block w-full"
                                            :options="attr?.distances"
                                        />
                                        <InputError class="mt-2" :message="addresses.errors.distance" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="traveling_time" value="Waktu Tempuh" />
                                        <Select
                                            id="traveling_time"
                                            v-model="addresses.traveling_time"
                                            class="mt-1 block w-full"
                                            :options="attr?.traveling_times"
                                        />
                                        <InputError class="mt-2" :message="addresses.errors.traveling_time" />
                                    </div>
                                    
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="addresses.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': addresses.processing }" :disabled="addresses.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                    <tab name="father" :title="attr?.title_father">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_father }}
                            </template>

                            <template #description>
                                {{ attr?.title_father_desc }} 
                            </template>

                            <template #form>

                                <div class="col-span-6 sm:col-span-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel for="status" value="Status Ayah" />
                                        <Select
                                            id="status"
                                            v-model="father.status"
                                            class="mt-1 block w-full"
                                            :options="attr?.parentguardianstatus"
                                        />
                                        <InputError :message="father.errors.status" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="nik" value="Nik" />
                                                <TextInput
                                                    id="nik"
                                                    v-model="father.nik"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    autofocus
                                                />
                                                <InputError :message="father.errors.nik" class="mt-2" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="father_name" value="Nama Ayah" />
                                                <TextInput
                                                    id="father_name"
                                                    v-model="father.name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError :message="father.errors.name" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="place_of_birth" value="Tempat Lahir" />
                                                <TextInput
                                                    id="place_of_birth"
                                                    v-model="father.place_of_birth"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="father.errors.place_of_birth" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                                <VueDatePicker 
                                                    id="date_of_birth"
                                                    v-model="father.date_of_birth"
                                                    class="mt-1 block w-full"
                                                    format="dd/MM/yyyy"
                                                >
                                                </VueDatePicker>
                                                <InputError class="mt-2" :message="father.errors.date_of_birth" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="education" value="Pendidikan" />
                                        <Select
                                            id="education"
                                            v-model="father.education"
                                            class="mt-1 block w-full"
                                            :options="attr?.educations"
                                        />
                                        <InputError class="mt-2" :message="father.errors.education" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="work" value="Pekerjaan" />
                                        <Select
                                            id="work"
                                            v-model="father.work"
                                            class="mt-1 block w-full"
                                            :options="attr?.works"
                                        />
                                        <InputError class="mt-2" :message="father.errors.work" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="income" value="Penghasilan" />
                                        <Select
                                            id="income"
                                            v-model="father.income"
                                            class="mt-1 block w-full"
                                            :options="attr?.incomes"
                                        />
                                        <InputError class="mt-2" :message="father.errors.income" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="phone" value="No. HP" />
                                        <TextInput
                                            id="phone"
                                            v-model="father.phone"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError class="mt-2" :message="father.errors.phone" />
                                    </div>
                                    
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="father.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': father.processing }" :disabled="father.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                    <tab name="mother" :title="attr?.title_mother">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_mother }}
                            </template>

                            <template #description>
                                {{ attr?.title_mother_desc }} 
                            </template>

                            <template #form>

                                <div class="col-span-6 sm:col-span-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <InputLabel for="status" value="Status Ibu" />
                                        <Select
                                            id="status"
                                            v-model="mother.status"
                                            class="mt-1 block w-full"
                                            :options="attr?.parentguardianstatus"
                                        />
                                        <InputError :message="mother.errors.status" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="nik" value="Nik" />
                                                <TextInput
                                                    id="nik"
                                                    v-model="mother.nik"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    autofocus
                                                />
                                                <InputError :message="mother.errors.nik" class="mt-2" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="mother_name" value="Nama Ibu" />
                                                <TextInput
                                                    id="mother_name"
                                                    v-model="mother.name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError :message="mother.errors.name" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="place_of_birth" value="Tempat Lahir" />
                                                <TextInput
                                                    id="place_of_birth"
                                                    v-model="mother.place_of_birth"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="mother.errors.place_of_birth" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                                <VueDatePicker 
                                                    id="date_of_birth"
                                                    v-model="mother.date_of_birth"
                                                    class="mt-1 block w-full"
                                                    format="dd/MM/yyyy"
                                                >
                                                </VueDatePicker>
                                                <InputError class="mt-2" :message="mother.errors.date_of_birth" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="education" value="Pendidikan" />
                                        <Select
                                            id="education"
                                            v-model="mother.education"
                                            class="mt-1 block w-full"
                                            :options="attr?.educations"
                                        />
                                        <InputError class="mt-2" :message="mother.errors.education" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="work" value="Pekerjaan" />
                                        <Select
                                            id="work"
                                            v-model="mother.work"
                                            class="mt-1 block w-full"
                                            :options="attr?.works"
                                        />
                                        <InputError class="mt-2" :message="mother.errors.work" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="income" value="Penghasilan" />
                                        <Select
                                            id="income"
                                            v-model="mother.income"
                                            class="mt-1 block w-full"
                                            :options="attr?.incomes"
                                        />
                                        <InputError class="mt-2" :message="mother.errors.income" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="phone" value="No. HP" />
                                        <TextInput
                                            id="phone"
                                            v-model="mother.phone"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError class="mt-2" :message="mother.errors.phone" />
                                    </div>
                                    
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="mother.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': mother.processing }" :disabled="mother.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                    <tab name="guardian" :title="attr?.title_guardian">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_guardian }}
                            </template>

                            <template #description>
                                {{ attr?.title_guardian_desc }} 
                            </template>

                            <template #form>

                                <div class="col-span-6 sm:col-span-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="nik" value="Nik" />
                                                <TextInput
                                                    id="nik"
                                                    v-model="guardian.nik"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    autofocus
                                                />
                                                <InputError :message="guardian.errors.nik" class="mt-2" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="mother_name" value="Nama Wali" />
                                                <TextInput
                                                    id="mother_name"
                                                    v-model="guardian.name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError :message="guardian.errors.name" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                                            <div class="mt-4">
                                                <InputLabel for="place_of_birth" value="Tempat Lahir" />
                                                <TextInput
                                                    id="place_of_birth"
                                                    v-model="guardian.place_of_birth"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                />
                                                <InputError class="mt-2" :message="guardian.errors.place_of_birth" />
                                            </div>
                                            <div class="mt-4">
                                                <InputLabel for="date_of_birth" value="Tanggal Lahir" />
                                                <VueDatePicker 
                                                    id="date_of_birth"
                                                    v-model="guardian.date_of_birth"
                                                    class="mt-1 block w-full"
                                                    format="dd/MM/yyyy"
                                                >
                                                </VueDatePicker>
                                                <InputError class="mt-2" :message="guardian.errors.date_of_birth" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="education" value="Pendidikan" />
                                        <Select
                                            id="education"
                                            v-model="guardian.education"
                                            class="mt-1 block w-full"
                                            :options="attr?.educations"
                                        />
                                        <InputError class="mt-2" :message="guardian.errors.education" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="work" value="Pekerjaan" />
                                        <Select
                                            id="work"
                                            v-model="guardian.work"
                                            class="mt-1 block w-full"
                                            :options="attr?.works"
                                        />
                                        <InputError class="mt-2" :message="guardian.errors.work" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="income" value="Penghasilan" />
                                        <Select
                                            id="income"
                                            v-model="guardian.income"
                                            class="mt-1 block w-full"
                                            :options="attr?.incomes"
                                        />
                                        <InputError class="mt-2" :message="guardian.errors.income" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-4">
                                        <InputLabel for="phone" value="No. HP" />
                                        <TextInput
                                            id="phone"
                                            v-model="guardian.phone"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError class="mt-2" :message="guardian.errors.phone" />
                                    </div>
                                    
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="guardian.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': guardian.processing }" :disabled="guardian.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                </tabs>
            </div>
        </section>
    </HomeLayout>
</template>
