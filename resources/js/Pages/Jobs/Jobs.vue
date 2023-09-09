<template>
    <AuthenticatedLayout>
        <div class="py-6">
            
            <div class="grid grid-cols-3 max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4">
                <div class="col-span-2 p-4 sm:p-8 bg-white shadow sm:rounded-lg"> 
                    <h1 class="text-2xl mb-8">Available Job Listings</h1>


                    <JobFilters />

                    <div class="space-y-5">
                        <div v-for="(job, index) in jobListingStore.jobs" :key="index">
                            <div class="border border-slate-200 shadow rounded-md p-4">
                                <div class="grid grid-cols-2">
                                    <div>
                                        <h3 class="h3 text-xl text-bold">{{ job.role }}</h3>
                                        <h5 class="text-md">{{ job.title }}</h5>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="text-md">{{ job.entity }}</h5>
                                        <h6 class="text-sm">Added {{ job.createdAt }}</h6>
                                    </div>
                                </div>
                                <p class="mt-3">{{ job.description }}</p>
                                <div class="flex justify-end space-x-2">
                                    <PrimaryButton class="mt-6" @click="quickApplyStore.initializeFlow(job)" >
                                        Quick Apply
                                        <LoadingSpinner v-if="job.loading" classes="text-white" ></LoadingSpinner>
                                    </PrimaryButton>
                                    <SecondaryButton class="mt-6" @click="console.log('test')" >
                                        View Job
                                    </SecondaryButton>
                                </div>
                            </div>
                        </div>
                        <Pagination 
                            v-if="jobListingStore.jobPaginationData" 
                            :pagination-data="jobListingStore.jobPaginationData" 
                            @change-page="jobListingStore.handleJobPaginationEvent" 
                        />
                    </div>
                </div>
                <div class="col-span-1">
                    <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h3 class="h3 text-xl mb-5">Recommended Jobs</h3>
                        <div v-for="(job, index) in jobListingStore.recommendedJobs" :key="index" class="mb-5">
                            <div class="border border-slate-200 shadow rounded-md p-3">
                                <div>
                                    <div>
                                        <h4 class="h3 text-lg text-bold">{{ job.role }}</h4>
                                        <h5 class="text-sm">{{ job.entity }}</h5>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="text-sm">{{ job.location }}</h6>
                                    </div>
                                </div>
                                <p class="mt-3">{{ job.description }}</p>
                                <div class="flex justify-end space-x-2">
                                    <PrimarySmallButton class="mt-3" @click="console.log('test')" >
                                        Apply
                                    </PrimarySmallButton>
                                    <SecondarySmallButton class="mt-3" @click="console.log('test')" >
                                        View
                                    </SecondarySmallButton>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <Transition>
            <QuickApplyFlow v-if="quickApplyStore.showQuickApplication" />
        </Transition>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import { useJobListingStore } from '@/Stores/job-listings.store';
import { useQuickApplyFlowStore } from '@/Stores/quick-apply.store';
import PrimarySmallButton from '@/Components/PrimarySmallButton.vue';
import SecondarySmallButton from '@/Components/SecondarySmallButton.vue';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';
import QuickApplyFlow from '@/Pages/Jobs/QuickApplyFlow.vue';
import Pagination from '@/Components/Pagination.vue';
import JobFilters from './components/JobFilters.vue';

const quickApplyStore = useQuickApplyFlowStore();
const jobListingStore = useJobListingStore();

onMounted(async () => {
    jobListingStore.getJobs();
    jobListingStore.getRecommendedJobs();
})

</script>