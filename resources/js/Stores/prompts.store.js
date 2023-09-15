import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import PromptsApi from "@/Pages/Prompts/services/PromptsApi";

export const usePromptsStore = defineStore('promptsStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = PromptsApi.make();
    const prompts = ref();
    const paginationData = ref();
    const editingPrompt= ref();
    
    async function getPrompts(page = 1, perPage) {
        const { data } = await api.getPrompts({ page: page, per_page: perPage });
        prompts.value = data.resp.prompts_paginated.data;
        paginationData.value = data.resp.prompts_paginated;
    }

    async function handlePaginationEvent(newPageUrl) {
        getPrompts(newPageUrl.newPage, newPageUrl.perPage);
    }

    return {
        api, 
        prompts,
        paginationData,
        getPrompts,
        handlePaginationEvent
    }
})