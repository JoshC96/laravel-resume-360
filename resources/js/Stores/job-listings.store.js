import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import ProfileApi from "@/Services/ProfileApi";
import JobsApi from "@/Services/JobsApi";


export const useJobListingStore = defineStore('jobListingStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = JobsApi.make();
    const jobs = ref();
    const jobPaginationData = ref();
    const recommendedJobs = ref([]);
    
    async function getJobs(page = 1, perPage) {
        const { data } = await api.getJobs({ page: page, per_page: perPage });
        jobs.value = data.resp.jobs_paginated.data;
        jobPaginationData.value = data.resp.jobs_paginated;
    }

    async function handleJobPaginationEvent(newPageUrl) {
        getJobs(newPageUrl.newPage, newPageUrl.perPage);
    }

    async function getRecommendedJobs() {
        const { data } = await api.getRecommendedJobs();
        recommendedJobs.value = data.resp.jobs;
    }

    async function quickApply(jobId) {
        return await api.quickApply(jobId);
    }

    return {
        api, 
        jobs,
        jobPaginationData,
        recommendedJobs,
        getJobs,
        getRecommendedJobs,
        quickApply,
        handleJobPaginationEvent
    }
})