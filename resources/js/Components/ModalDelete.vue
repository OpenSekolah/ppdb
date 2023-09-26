<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import { router } from '@inertiajs/vue3'
import { alertMessage } from '@/Utils/global.js';

const openModelDelete = ref(false);
const emit = defineEmits(['close']);

const props = defineProps({
    title: {
        type: String,
        default: 'Are You Sure You Want To Delete This',
    },
	content: {
        type: String,
        default: 'You will not be able to recover this data!!!',
    },
	delete_url: {
        type: String,
        required: true,
    }
});

const processing = ref(false);

const startConfirmingDelete = () => {
    openModelDelete.value = true;
};

const closeModal = () => {
	emit('close', 'refresh');
    openModelDelete.value = false;
};

const deleteItem = () => {
	processing.value = true;
	router.delete(props.delete_url, {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
			alertMessage();
        },
		onFinish: () => {
			processing.value = false;
        },
    });
};

</script>

<template>
    <span>
        <span @click="startConfirmingDelete">
            <slot />
        </span>

        <DialogModal
			:show="openModelDelete"
			:closeable="true"
			@close="closeModal" >
			<template #content>
				<div class="p-5 text-center">
					<div class="text-2xl mt-5">{{title}}</div>
					<div class="text-slate-500 mt-2">{{content}}</div>
				</div>
			</template>

			<template #footer>
				<button type="button"  @click="deleteItem" :disabled="processing" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-700 hover:text-gray-50 focus:outline-none focus:bg-red-50 active:bg-red-50 transition ease-in-out duration-150">
					Delete
				</button>
				&nbsp;
				<button type="button"  @click="closeModal" :disabled="processing" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
					Cancel
				</button>
			</template>
        </DialogModal>
    </span>
</template>
