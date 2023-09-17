<template>
    <div class="mb-5">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <InputLabel for="keywords" value="Content Keywords" />
                <TextInput id="keywords" type="text" placeholder="Keywords" class="mt-1 block w-full" v-model="keywords" />
            </div>
            <div>
                <InputLabel for="createdBy" value="Created By" />
                <TextInput id="createdBy" type="text" placeholder="Name" class="mt-1 block w-full" v-model="createdBy" />
            </div>
            <div>
                <InputLabel value="Created At" />
                <DateRangeInput 
                    :date-value="createdAt" 
                    @update-date-range="createdAt = $event" 
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePromptsStore } from '@/Stores/prompts.store'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import DateRangeInput from '@/Components/DateRangeInput.vue';

const promptStore = usePromptsStore();

const createdAt = ref([
    new Date(),
    new Date(),
]);
const keywords = ref('');
const createdBy = ref('');

</script>