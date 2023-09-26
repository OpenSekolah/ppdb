<script setup>
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import Button from '@/Components/Button.vue';

const iframeStatus = ref(false);
iframeStatus.value = false;
const openModelDelete = ref(false);

const props = defineProps({
	title: {
		type: String,
		default: '-',
	},
	src_url: {
		type: String,
		default: '',
	},
	max_width: {
		type: String,
		default: '7xl',
	}
});

const startModal = () => {
    openModelDelete.value = true;
};

const closeModal = () => {
    openModelDelete.value = false;
	iframeStatus.value = false;
};

function onloadPage() {
	iframeStatus.value = true;
}

</script>

<template>
	<span>
		<span @click="startModal">
			<slot />
		</span>

		<DialogModal :show="openModelDelete" @close="closeModal" :maxWidth="max_width">
			<template #title>
				<b><i>{{ title }}</i></b>
			</template>

			<template #content>
				<div class="mt-4">
					<svg v-show="!iframeStatus" class="animate-spin w-20 h-20 text-primary mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
					</svg>
					<div class="overflow-x-auto">
						<iframe v-show="iframeStatus" class="w-full h-screen" :src="src_url" @load="onloadPage()" :key="src_url"></iframe>
					</div>
				</div>
			</template>

			<template #footer>
				<Button @click="closeModal" button_type="secondary" class="mr-2">
					Keluar
				</Button>
			</template>
		</DialogModal>
	</span>
</template>
	