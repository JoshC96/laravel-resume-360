<template>
    <Modal 
        :show="profileStore.showExperienceModal"
        @close="profileStore.closeExperienceModal"
        @confirm="profileStore.saveExperience"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingExperience.id ? 'Edit' : 'Create' }} Work Experience</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
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
                    <InputLabel for="position" value="Position *" />

                    <TextInput
                        id="position"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingExperience.position"
                        required
                    />
                </div>
                <div>
                    <InputLabel for="description" value="Describe your responsibilities  *" />

                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingExperience.description"
                        required
                    />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import {ref} from 'vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import { useUserProfileStore } from '@/Stores/user-profile.store.js';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
})

const profileStore = useUserProfileStore();

const startedAt = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});
const finishedAt = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});


</script>