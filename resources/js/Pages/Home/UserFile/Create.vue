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

const activeTab = ref('photo');
const photoInput = ref(null);
const kkInput = ref(null);
const ijazahInput = ref(null);

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

const photo = useForm({
    _method: 'POST',
    type: 'photo',
    file_photo: null,
});

const kk = useForm({
    _method: 'POST',
    type: 'kk',
    file_photo: null,
});

const ijazah = useForm({
    _method: 'POST',
    type: 'ijazah',
    file_photo: null,
});

const createModel = () => {
    if(activeTab.value == 'photo') {
        if(photoInput.value) {
            photo.file_photo = photoInput.value.files[0];
        }

        photo.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    } else if(activeTab.value == 'kk') {
        if(kkInput.value) {
            kk.file_photo = kkInput.value.files[0];
        }

        kk.post(props?.attr?.route_url, {
            preserveScroll: true,
            onSuccess: () => {
                alertMessage();
            },
        });
    } else if(activeTab.value == 'ijazah') {
        if(ijazahInput.value) {
            ijazah.file_photo = ijazahInput.value.files[0];
        }

        ijazah.post(props?.attr?.route_url, {
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
                    <tab name="photo" :title="attr?.title_photo">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_photo }}
                            </template>

                            <template #description>
                                {{ attr?.title_photo_desc }} 
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="year" value="Foto" />
                                    <input 
                                        ref="photoInput"
                                        type="file" 
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200" 
                                    />
                                    <InputError class="mt-2" :message="photo.errors.file_photo" />

                                    <img 
                                        v-if="attr?.photo_model?.photoAt"
                                        :src="attr?.photo_model?.photoAt" 
                                        class="h-auto max-w-xs rounded-xs mt-7 "
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="photo.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': photo.processing }" :disabled="photo.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>
                    <tab name="kk" :title="attr?.title_kk">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_kk }}
                            </template>

                            <template #description>
                                {{ attr?.title_kk_desc }} 
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="year" value="Kartu Keluarga" />
                                    <input 
                                        ref="kkInput"
                                        type="file" 
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200" 
                                    />
                                    <InputError class="mt-2" :message="kk.errors.file_photo" />

                                    <img 
                                        v-if="attr?.kk_model?.photoAt"
                                        :src="attr?.kk_model?.photoAt" 
                                        class="h-auto max-w-6xl rounded-lg mt-7 "
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="kk.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': kk.processing }" :disabled="kk.processing">
                                    Simpan
                                </Button>
                            </template>
                        </FormSection>
                    </tab>

                    <tab name="ijazah" :title="attr?.title_ijazah">
                        <FormSection full_layout="grid grid-cols-1 gap-6" @submitted="createModel">
                            <template #title>
                                {{ attr?.title_ijazah }}
                            </template>

                            <template #description>
                                {{ attr?.title_ijazah_desc }} 
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <InputLabel for="year" value="Ijazah/SKL" />
                                    <input 
                                        ref="ijazahInput"
                                        type="file" 
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200" 
                                    />
                                    <InputError class="mt-2" :message="ijazah.errors.file_photo" />

                                    <img 
                                        v-if="attr?.ijazah_model?.photoAt"
                                        :src="attr?.ijazah_model?.photoAt" 
                                        class="h-auto max-w-6xl rounded-lg mt-7 "
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <ActionMessage :on="ijazah.recentlySuccessful" class="mr-3">
                                    Saved.
                                </ActionMessage>

                                <Button :class="{ 'opacity-25': ijazah.processing }" :disabled="ijazah.processing">
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
