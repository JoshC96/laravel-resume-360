<template>
    <Modal :show="true" @close="store.cancelQuickApply" @confirm="store.nextSlide">
        <template v-slot:header>
            <h2 class="h2 text-xl">Confirm Contact Details</h2>
        </template>
        <template v-slot:content>
            <p class="mb-5">For the best chance of having your application viewed, we recommend adding your email address and phone number. 
                Please confirm the below details are correct.</p>

            <div class="space-y-6">
                <div>
                    <InputLabel for="email" value="Email *" />

                    <TextInput 
                        id="email" 
                        type="email" 
                        class="mt-1 block w-full"
                        v-model="store.application.applicantEmail" 
                        required />
                </div>
                <div>
                    <InputLabel for="phone" value="Phone *" />

                    <TextInput 
                        id="phone" 
                        type="text"
                        pattern="\d+"
                        class="mt-1 block w-full"
                        v-model="store.application.applicantPhone" 
                        required />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';

const store = useQuickApplyFlowStore();


</script>