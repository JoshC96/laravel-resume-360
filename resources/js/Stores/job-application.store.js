import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import JobsApi from "@/Services/JobsApi";


export const useJobApplicationStore = defineStore('jobApplicationStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = JobsApi.make();
    const applications = ref([]);
    
    async function getApplications() {
        const { data } = await api.getApplications();
        applications.value = data.resp.applications;
    }

    return {
        api, 
        applications,
        getApplications,
    }
}, { 
    persist: false
})