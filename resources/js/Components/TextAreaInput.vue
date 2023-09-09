<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    ref: {
        type: String,
        required: false,
    },
    modelValue: {
        required: true,
    },
    disabled: {
        type: Boolean,
        default: false
    },
    rows: {
        type: Number,
        required: false,
        default: 10
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        ref="input"
        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :disabled="disabled"
        :value="modelValue"
        :rows="rows"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
</template>
