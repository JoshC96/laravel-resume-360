<template>
    <div class="mb-5">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <InputLabel for="createdBy" value="Created By" />
                <TextInput id="createdBy" type="text" placeholder="Name" class="mt-1 block w-full" v-model="createdBy" />
            </div>
            <div>
                <InputLabel value="Created At" />
                <VueDatePicker v-model="createdAt" range :format="createdAtFormat" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useTemplatesStore } from '@/Stores/templates.store'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const createdAt = ref([
    new Date(),
    new Date(),
]);
const createdBy = ref('');

const templatesStore = useTemplatesStore();

const createdAtFormat = (date) => {
    const firstDay = date[0].getDate();
    const firstMonth = date[0].getMonth() + 1;
    const firstYear = date[0].getFullYear();

    const secondDay = date[1].getDate();
    const secondMonth = date[1].getMonth() + 1;
    const secondYear = date[1].getFullYear();

    return `${firstDay}/${firstMonth}/${firstYear} - ${secondDay}/${secondMonth}/${secondYear}`;
}


</script>