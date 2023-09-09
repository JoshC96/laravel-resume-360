<template>
    <Modal :show="true" @close="store.cancelQuickApply" @confirm="store.nextSlide">
        <template v-slot:header>
            <h2 class="h2 text-xl">Create Cover Letter</h2>
        </template>
        <template v-slot:content>

            <div v-if="store.loading" class="text-center">
                <p class="mb-5">We're generating your application now...</p>
                <LoadingSpinner />
            </div>

            <div v-else class="space-y-6">
                <TextAreaInput 
                    ref="coverLetterInput"
                    class="mt-1 block w-full" 
                    :class="!editCoverLetter ? 'opacity-75' : ''"
                    :rows="25" 
                    :disabled="!editCoverLetter" 
                    v-model="store.application.coverLetter" 
                    required />
            </div>
        </template>
        <template v-slot:buttons>
            <button 
                v-if="showEditButton && !store.loading"
                @click.stop="allowCoverLetterEditing()"
                class="transition duration-100 bg-green-600 hover:bg-green-500 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6">
                Edit Cover Letter
            </button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';
import { ref, onMounted } from 'vue';

const store = useQuickApplyFlowStore();
const editCoverLetter = ref(false);
const showEditButton = ref(true);
const coverLetterInput = ref(null);

function allowCoverLetterEditing() {
    editCoverLetter.value = true;
    store.application.userEditedCoverLetter = true;
    setTimeout(() => {
        coverLetterInput.value.focus()    
    }, 50);
    showEditButton.value = false;
}


onMounted(() => {
    store.generateCoverLetter();
})


</script>