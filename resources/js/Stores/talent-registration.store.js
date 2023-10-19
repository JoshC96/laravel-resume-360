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
        api.register(entity.value).then((resp) => {
            window.location.href = 'entity/' + resp.data.data.entity.id;
        }).catch((error) => {
            errorMessage.value = error.message || error;
        }).finally(() => {
            loading.value = false;
        });

    }

    return {
        api,
        entity,
        loading,
        errorMessage,
        register
    }
})