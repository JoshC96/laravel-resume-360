<template>
    <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div>
            <InputLabel for="createdBy" value="Created By" />
            <TextInput id="createdBy" type="text" placeholder="Name" class="mt-1 block w-full" v-model="createdBy" />
        </div>
        <div>
            <InputLabel value="Created At" class="mb-1" />
            <DateRangeInput 
                :date-value="createdAt" 
                @update-date-range="createdAt = $event" 
            />
        </div>

        <div>
            <button 
                @click.stop="templatesStore.triggerEditTemplateForm"
                class="transition duration-100 bg-indigo-500 hover:bg-indigo-400 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6">
                Create New Template
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useTemplatesStore } from '@/Stores/templates.store'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import DateRangeInput from '@/Components/DateRangeInput.vue';

const createdAt = ref([
    new Date(),
    new Date(),
]);
const createdBy = ref('');

const templatesStore = useTemplatesStore();


</script>