<template>
    <VueDatePicker  
        range 
        ref="dateRange" 
        :format="dateListedFormat" 
        :placeholder="placeholder" 
        :model-value="dateValue" 
        @update:model-value="$emit('updateDateRange', $event)"
        input-class-name="py-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:opacity-50"
    />
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    dateValue: {
        type: Array,
        default: [
            new Date(),
            new Date(),
        ]
    },
    placeholder: {
        type: String,
        required: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
});

const emit = defineEmits(['updateDateRange']);

const dateRange = ref(null);

const dateListedFormat = (date) => {
    const firstDay = date[0].getDate();
    const firstMonth = date[0].getMonth() + 1;
    const firstYear = date[0].getFullYear();

    const secondDay = date[1]?.getDate() ?? '-';
    const secondMonth = date[1]?.getMonth() + 1 ?? '-';
    const secondYear = date[1]?.getFullYear() ?? '-';

    return `${firstDay}/${firstMonth}/${firstYear} - ${secondDay}/${secondMonth}/${secondYear}`;
}
</script>
