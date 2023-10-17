<template>
    <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-5">
        <h3 class="h3 text-2xl mb-5">{{ title }}</h3>
        <div v-for="(item, index) in items" :key="index"
            class="flex items-center px-5 py-6 bg-white shadow-sm">
            <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full text-white min-w-[50px] text-center"> {{ item.count }} </div>
            <div class="mx-5">
                <h4 class="text-2x1 font-semibold text-gray-700">{{ currency ? formatCurrency(item.total) : item.total }}</h4>
                <div class="text-gray-500 capitalize">{{ index.toString().replace(/-/g, ' ') }}</div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { formatCurrency } from '@/Formatters';

defineProps({
    title: String,
    items: Array,
    currency: Boolean
})

</script>