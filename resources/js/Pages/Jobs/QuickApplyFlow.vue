<template>
    <div>

        <div v-if="store.currentSlide === 'ConfirmQuickApply'">
            <ConfirmQuickApply />
        </div>

        <div v-if="store.currentSlide === 'EditCoverLetter'">
            <EditCoverLetter />
        </div>

        <div v-if="store.currentSlide === 'ContactDetails'">
            <ContactDetails />
        </div>

        <div v-if="store.currentSlide === 'ReviewApplication'">
            <ReviewApplication />
        </div>

    </div>
</template>

<script setup>
import ConfirmQuickApply from '@/Pages/Jobs/slides/ConfirmQuickApply';
import ContactDetails from '@/Pages/Jobs/slides/ContactDetails';
import EditCoverLetter from '@/Pages/Jobs/slides/EditCoverLetter';
import ReviewApplication from '@/Pages/Jobs/slides/ReviewApplication';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';

const store = useQuickApplyFlowStore();


</script>