<script setup >
import { onMounted, ref } from 'vue';

const props = defineProps({
  modelValue: {
    type: Number,
		default: null
	},
  options: {
		type: Object,
		default: {},
	},
	model: {
		type: Boolean,
		default: false,
	},
	error_message: String,
});

defineEmits(['update:modelValue']);

const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});
</script>

<template>
  <select
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    @change="$emit('update:modelValue', String($event.target.value))"
    ref="select"
  >
    <option
      v-for="(data, key) in options"
      :key="key"
	    :model="model == true ? JSON.stringify(data) : ''"
      :value="Number(data.id)"
      :selected="Number(data.id) == Number(modelValue)"
    >
      {{ data.name }}
    </option>
  </select>
</template>
