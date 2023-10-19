import { defineStore } from "pinia";
import { ref } from "vue";
import EntityApi from "@/Services/EntityApi";

export const useEntityStore = defineStore('entityStore', () => {
    const api = EntityApi.make();
    const loading = ref(false);
    const errorMessage = ref('');
    const userEntities = ref([]);

    async function getUserEntities(payload) {
        const { data } = await api.getEntities({ user_id: api.userId, ...payload });
        userEntities.value = data.resp.entities.data;
    }

    return {
        api,
        loading,
        errorMessage,
        userEntities,
        getUserEntities
    }
})