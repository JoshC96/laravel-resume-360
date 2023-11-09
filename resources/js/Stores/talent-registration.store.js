import { defineStore } from "pinia";
import { ref } from "vue";
import EntityApi from "@/Services/EntityApi";

export const useTalentRegistrationStore = defineStore('talentRegistrationStore', () => {
    const api = EntityApi.make();
    const entity = ref({
        name: null,
        phone: null,
        website: null,
        type: null,
        employee_size: null
    })

    const loading = ref(false);
    const errorMessage = ref('');

    async function register() {
        loading.value = true;
        const resp = await api.register(entity.value);
        window.location.href = '/entity/' + resp.data.resp.entity.id;
        loading.value = false;
    }

    return {
        api,
        entity,
        loading,
        errorMessage,
        register
    }
})