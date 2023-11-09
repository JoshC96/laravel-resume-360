import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import UserApi from "@/Services/UserApi";


export const useUserManagementStore = defineStore('userManagementStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = UserApi.make();

    const users = ref();
    const userPaginationData = ref();
    const showUserEditModal = ref(false);
    const editingUser = ref({});

    async function getUsers(entityId, page = 1, perPage) {
        const { data } = await api.getUsers({ entityId: entityId, page: page, per_page: perPage });
        users.value = data.resp.users_paginated.data;
        userPaginationData.value = data.resp.users_paginated;
    }

    async function handleUserPaginationEvent(newPageUrl, entityId) {
        getUsers(entityId, newPageUrl.newPage, newPageUrl.perPage);
    }

    async function saveUser() {
        if (editingUser.value.id) {
            const { data } = await api.updateUser(editingUser.value.id, editingUser.value)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated user')
                closeUserModal();
                getUsers();
            } else {
                userFlashStore.reportError('Error updating user, please try again later')
            }
        } else {
            const { data } = await api.createUser(editingUser.value)

            if (data.resp?.user) {
                userFlashStore.showSuccess('Added a new user')
                closeUserModal();
                getUsers();
            } else {
                userFlashStore.reportError('Error creating user, please try again later')
            }
        }
    }

    function impersonateUser(uuid) {
        return window.location = `/user/${uuid}/impersonate`;
    }

    function triggerEditUserForm(user) {
        editingUser.value = { ...user };
        showUserEditModal.value = true
    }

    function closeUserModal() {
        editingUser.value = {};
        showUserEditModal.value = false
    }

    return {
        api, 
        users,
        showUserEditModal,
        editingUser,
        getUsers,
        handleUserPaginationEvent,
        saveUser,
        triggerEditUserForm,
        closeUserModal,
        impersonateUser
    }
}, { 
    persist: false
})