<template>
    <Modal 
        :show="profileStore.showQualificationModal"
        @close="profileStore.closeQualificationModal"
        @confirm="profileStore.saveQualification"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingQualification?.id ? 'Edit' : 'Create' }} Qualification</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <InputLabel for="name" value="Name *" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingQualification.name"
                        required
                    />
                </div>
                <div>
                    <InputLabel for="field" value="Field *" />

                    <TextInput
                        id="field"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingQualification.field"
                        required
                    />
                </div>
                <div class="grid md:grid-cols-2 gap-5"> 
                    <div>
                        <InputLabel for="started_at" value="Started *" />

                        <VueDatePicker v-model="startedAt" month-picker />
                    </div>
                    <div>
                        <InputLabel for="finished_at" value="Ended *" />

                        <VueDatePicker v-model="finishedAt" month-picker />
                    </div>
                </div>
                <div>
                    <InputLabel for="description" value="Description" />

                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingQualification.description"
                    />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import { ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import { useUserProfileStore } from '@/Stores/user-profile.store.js';

const profileStore = useUserProfileStore();

const startedAt = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});
const finishedAt = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});


watch(startedAt, (newVal) => {
    profileStore.editingQualification.started_month = newVal.month;
    profileStore.editingQualification.started_year = newVal.year;
})

watch(finishedAt, (newVal) => {
    profileStore.editingQualification.finished_month = newVal.month;
    profileStore.editingQualification.finished_year = newVal.year;
})



</script>