import { defineStore } from "pinia";
import { reactive, ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import PermissionsApi from "@/Services/PermissionsApi";

export const usePermissionsStore = defineStore('permissionsStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = PermissionsApi.make();
    const permissions = ref([]);
    const roles = ref([]);

    const editingPermission = ref({});
    const editingRole = ref({});
    const showPermissionForm = ref(false);
    const showRoleForm = ref(false);
    
    async function getRoles() {
        const { data } = await api.getRoles();
        roles.value = data.resp.roles;
    }

    async function getPermissions() {
        const { data } = await api.getPermissions();
        permissions.value = data.resp.permissions;
    }

    function triggerEditPermissionForm(permission) {
        editingPermission.value = { ...permission };
        showPermissionForm.value = true
    }

    function triggerEditRoleForm(role) {
        editingRole.value = { ...role };
        showRoleForm.value = true
    }


    async function deletePermission(permissionId) {
        if (permissionId) {
            const { data } = await api.deletePermission(permissionId)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Deleted permission')
                getPermissions();
            } else {
                userFlashStore.reportError('Error deleting permission, please try again later')
            }
        } else {
            userFlashStore.reportError('A permission ID is required.')
        }
    }

    async function savePermission() {
        if (editingPermission.value.id) {
            const { data } = await api.updatePermission(editingPermission.value.id, editingPermission.value)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated permission')
                closePermissionModal();
                getPermissions();
            } else {
                userFlashStore.reportError('Error updating permission, please try again later')
            }
        } else {
            const { data } = await api.createPermission(editingPermission.value)

            if (data.resp?.permission) {
                userFlashStore.showSuccess('Added a new permission')
                closePermissionModal();
                getPermissions();
            } else {
                userFlashStore.reportError('Error creating permission, please try again later')
            }
        }
    }


    async function deleteRole(roleId) {
        if (roleId) {
            const { data } = await api.deleteRole(roleId)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Deleted role')
                getRoles();
            } else {
                userFlashStore.reportError('Error deleting role, please try again later')
            }
        } else {
            userFlashStore.reportError('A role ID is required.')
        }
    }

    async function saveRole() {
        console.log(editingRole.value)
        if (editingRole.value.id) {
            const { data } = await api.updateRole(editingRole.value.id, editingRole.value)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated role')
                closeRoleModal();
                getRoles();
            } else {
                userFlashStore.reportError('Error updating role, please try again later')
            }
        } else {
            const { data } = await api.createRole(editingRole.value)

            if (data.resp?.role) {
                userFlashStore.showSuccess('Added a new role')
                closeRoleModal();
                getRoles();
            } else {
                userFlashStore.reportError('Error creating role, please try again later')
            }
        }
    }

    function closePermissionModal() {
        showPermissionForm.value = false
        editingPermission.value = {};
    }

    function closeRoleModal() {
        showRoleForm.value = false
        editingRole.value = {};
    }


    return {
        api, 
        permissions,
        roles,
        editingPermission,
        editingRole,
        showPermissionForm,
        showRoleForm,
        getRoles,
        getPermissions,
        triggerEditPermissionForm,
        triggerEditRoleForm,
        savePermission,
        saveRole,
        deletePermission,
        deleteRole,
        closePermissionModal,
        closeRoleModal
    }
})