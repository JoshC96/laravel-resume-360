<template>
    <Modal 
        :show="profileStore.showLicenceModal"
        @close="profileStore.closeLicenceModal"
        @confirm="profileStore.saveLicence"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingLicence?.id ? 'Edit' : 'Create' }} Licence</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <InputLabel for="publicationName" value="Title *" />

                    <TextInput
                        id="publicationName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingLicence.name"
                        required
                    />
                </div>
                <div> 
                    <InputLabel for="issued" value="Issued *" />
                    <VueDatePicker v-model="issued" month-picker />
                </div>
                <div>
                    <InputLabel for="description" value="Description" />

                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingLicence.description"
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

const issued = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear()
});

watch(issued, (newVal) => {
    profileStore.editingLicence.issued_month = newVal.month;
    profileStore.editingLicence.issued_year = newVal.year;
})

</script>