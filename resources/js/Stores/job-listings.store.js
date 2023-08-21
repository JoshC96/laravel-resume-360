import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import ProfileApi from "@/Pages/Profile/services/ProfileApi";
import JobsApi from "@/Pages/Jobs/services/JobsApi";


export const useJobListingStore = defineStore('jobListingStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = JobsApi.make();
    const jobs = ref([]);
    const recommendedJobs = ref([]);
    
    async function getJobs() {
        const { data } = await api.getJobs();
        jobs.value = data.resp.jobs.data;
    }

    async function getRecommendedJobs() {
        const { data } = await api.getRecommendedJobs();
        recommendedJobs.value = data.resp.jobs;
    }

    async function quickApply(prompt) {
        return await api.quickApply(prompt);
    }

    return {
        api, 
        jobs,
        recommendedJobs,
        getJobs,
        getRecommendedJobs,
        quickApply
    }
}, { 
    persist: false
})