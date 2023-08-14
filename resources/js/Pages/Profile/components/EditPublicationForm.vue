<template>
    <Modal 
        :show="profileStore.showPublicationModal"
        @close="profileStore.closePublicationModal"
        @confirm="profileStore.savePublication"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingPublication?.id ? 'Edit' : 'Create' }} Publication</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <InputLabel for="publicationName" value="Title *" />

                    <TextInput
                        id="publicationName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingPublication.name"
                        required
                    />
                </div>
                <div> 
                    <InputLabel for="published" value="Published *" />
                    <VueDatePicker v-model="published" month-picker />
                </div>
                <div>
                    <InputLabel for="description" value="Description" />

                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingPublication.description"
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

const published = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});


watch(published, (newVal) => {
    profileStore.editingPublication.published_month = newVal.month;
    profileStore.editingPublication.published_year = newVal.year;
})

</script>