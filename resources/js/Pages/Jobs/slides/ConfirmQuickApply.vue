<template>
    <Modal :show="true" @close="store.cancelQuickApply" @confirm="store.nextSlide">
        <template v-slot:header>
            <h2 class="h2 text-xl">Quick Apply for {{ store.application.jobRole }}</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <p>By clicking 'Confirm' you agree to the generation of an application based on your information and
                        this will be shared with the company advertising the role.</p>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';

const store = useQuickApplyFlowStore();


</script>