import { defineStore } from "pinia";
import { ref } from "vue";
import EntityApi from "@/Services/EntityApi";

export const useEntityStore = defineStore('entityStore', () => {
    const api = EntityApi.make();
    const loading = ref(false);
    const errorMessage = ref('');
    const userEntities = ref([]);
    const entityContacts = ref([]);
    const entityLocations = ref([]);
    const entityJobs = ref([]);
    const entityContactsPaginationData = ref();
    const entityLocationsPaginationData = ref();
    const entityJobsPaginationData = ref();

    async function getUserEntities(payload) {
        const { data } = await api.getEntities({ user_id: api.userId, ...payload });
        userEntities.value = data.resp.entities.data;
    }

    async function getEntityContacts(entityId, payload) {
        const { data } = await api.getEntityContacts(entityId, { ...payload });
        entityContacts.value = data.resp.contacts.data;
        entityContactsPaginationData.value = data.resp.contacts;
    }

    async function getEntityLocations(entityId, payload) {
        const { data } = await api.getEntityLocations(entityId, { ...payload });
        entityLocations.value = data.resp.locations.data;
        entityLocationsPaginationData.value = data.resp.locations;
    }

    async function getEntityJobs(entityId, payload) {
        const { data } = await api.getEntityJobs(entityId, { ...payload });
        entityJobs.value = data.resp.jobs.data;
        entityJobsPaginationData.value = data.resp.jobs;
    }

    async function handleContactPaginationEvent(entityId, newPageUrl) {
        getEntityContacts(entityId, { page: newPageUrl.newPage, per_page: newPageUrl.perPage });
    }

    async function handleLocationPaginationEvent(entityId, newPageUrl) {
        getEntityLocations(entityId, { page: newPageUrl.newPage, per_page: newPageUrl.perPage });
    }

    async function handleEntityJobPaginationEvent(entityId, newPageUrl) {
        getEntityJobs(entityId, { page: newPageUrl.newPage, per_page: newPageUrl.perPage });
    }

    return {
        api,
        loading,
        errorMessage,
        userEntities,
        entityContacts,
        entityLocations,
        entityJobs,
        entityContactsPaginationData,
        entityLocationsPaginationData,
        entityJobsPaginationData,
        getUserEntities,
        getEntityContacts,
        getEntityLocations,
        getEntityJobs,
        handleContactPaginationEvent,
        handleLocationPaginationEvent,
        handleEntityJobPaginationEvent
    }
})