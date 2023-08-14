<template>
    <Modal 
        :show="profileStore.showCertificationModal"
        @close="profileStore.closeCertificationModal"
        @confirm="profileStore.saveCertification"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingCertification?.id ? 'Edit' : 'Create' }} Certification</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <InputLabel for="publicationName" value="Title *" />

                    <TextInput
                        id="publicationName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingCertification.name"
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
                        v-model="profileStore.editingCertification.description"
                    />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import {ref, watch} from 'vue';
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
    profileStore.editingCertification.issued_month = newVal.month;
    profileStore.editingCertification.issued_year = newVal.year;
})

</script>