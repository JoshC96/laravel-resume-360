<template>
    <select 
        class="leading-none py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:opacity-50"
        :class="class"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
    >
      <option disabled value="">{{ placeholder }}</option>
      <option v-for="option in options" :value="option.value">{{ option.label }}</option>
    </select>
</template>

<script setup>

defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        required: true,
    },
    placeholder: {
        type: String,
        required: false,
        default: "Select"
    },
    class: {
        required: false,
    },
});

defineEmits(['update:modelValue']);

</script>