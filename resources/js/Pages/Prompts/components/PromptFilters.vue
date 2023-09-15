<template>
    <div class="mb-5">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <InputLabel for="keywords" value="Content Keywords" />
                <TextInput id="keywords" type="text" placeholder="Keywords" class="mt-1 block w-full" v-model="keywords"
                    required />
            </div>
            <div>
                <InputLabel for="location" value="Created By" />
                <TextInput id="location" type="text" placeholder="Name" class="mt-1 block w-full" v-model="location"
                    required />
            </div>
            <div>
                <InputLabel value="Created At" />
                <VueDatePicker v-model="dateListed" range :format="dateListedFormat" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePromptsStore } from '@/Stores/prompts.store'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const dateListed = ref([
    new Date(),
    new Date(),
]);
const keywords = ref('');
const location = ref('');
const industry = ref('');

const promptStore = usePromptsStore();

const dateListedFormat = (date) => {
    const firstDay = date[0].getDate();
    const firstMonth = date[0].getMonth() + 1;
    const firstYear = date[0].getFullYear();

    const secondDay = date[1].getDate();
    const secondMonth = date[1].getMonth() + 1;
    const secondYear = date[1].getFullYear();

    return `${firstDay}/${firstMonth}/${firstYear} - ${secondDay}/${secondMonth}/${secondYear}`;
}


</script>