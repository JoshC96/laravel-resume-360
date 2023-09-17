<template>
    <Modal 
        :show="true" 
        @close="store.cancelQuickApply" 
        @confirm="store.completeApplication">
        <template v-slot:header>
            <h2 class="h2 text-xl">Review Application</h2>
        </template>
        <template v-slot:content>
            <div class="grid lg:grid-cols-2 gap-5">
                 <div>
                    <h4 class="text-lg">Role</h4>
                    <TextInput
                        disabled 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="store.application.jobRole" 
                        required />
                </div>
                <div>
                    <h4 class="text-lg">Company</h4>
                    <TextInput
                        disabled 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="store.application.entityName" 
                        required />
                </div>
                <div>
                    <h4 class="text-lg">Email</h4>
                    <TextInput
                        disabled 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="store.application.applicantEmail" 
                        required />
                </div>
                <div>
                    <h4 class="text-lg">Phone</h4>
                    <TextInput
                        disabled 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="store.application.applicantPhone" 
                        required />
                </div>
            </div>
            <div class="mt-5">
                <div class="my-4">
                    <h4 class="text-lg">Resume</h4>
                    <p>Coming soon.</p>
                </div>
                <div>
                    <h4 class="text-lg">Cover Letter</h4>
                    <TextAreaInput 
                        ref="coverLetterInput"
                        class="mt-1 block w-full" 
                        :class="!editCoverLetter ? 'opacity-75' : ''"
                        :rows="15" 
                        :disabled="true" 
                        v-model="store.application.coverLetter" 
                        required />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import TextInput from '@/Components/TextInput.vue';

const store = useQuickApplyFlowStore();


</script>