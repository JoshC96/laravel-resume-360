<template>
    <AuthenticatedLayout>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles & Permissions</h2>

        <div class="py-12">
            <div class="max-w-8xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-5">

                <div class="p-4 bg-white inline-block min-w-full overflow-hidden rounded-lg shadow">
                    <div class="flex flex-row justify-between mb-6">
                        <h2 class="h2 text-lg">Permissions</h2>
                        <PrimaryButton @click.stop="permissionsStore.triggerEditPermissionForm">Create</PrimaryButton>
                    </div>
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Name 
                                </th>
                                <th
                                    class="text-center px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="permissionsStore.permissions" v-for="permission in permissionsStore.permissions">
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ permission.name }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="flex justify-around">
                                        <button class="mx-2 rounded-md" @click="viewPermission(permission)" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    
                    <EditPermissionForm />
                </div>

                <div class="p-4 bg-white inline-block min-w-full rounded-lg shadow overflow-scroll">
                    <div class="flex flex-row justify-between mb-6">
                        <h2 class="h2 text-lg">Roles</h2>
                        <PrimaryButton @click.stop="permissionsStore.triggerEditRoleForm">Create</PrimaryButton>
                    </div>
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Permissions
                                </th>
                                <th
                                    class="text-center px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="permissionsStore.roles" v-for="role in permissionsStore.roles">
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ role.name }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        <span v-for="(permission, index) in role.permissions" >
                                            {{ permission }}{{ role.permissions.length > 1 && index + 1 !== role.permissions.length ? ', ' : '' }}
                                        </span>
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="flex justify-around">
                                        <button class="mx-2 rounded-md" @click="viewRole(role)" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <EditRoleForm :show-permissions="true" key="permissionUserManagement" />
                </div>    
            </div>

            <div class="py-12">
                <UserManagement :show-all="true" :key="1" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePermissionsStore } from '@/Stores/permissions.store';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { onMounted } from 'vue';
import EditPermissionForm from './components/EditPermissionForm.vue'
import EditRoleForm from './components/EditRoleForm.vue'
import UserManagement from '@/Modules/UserManagement.vue'

const permissionsStore = usePermissionsStore();

onMounted(async () => {
    permissionsStore.getRoles();
    permissionsStore.getPermissions();
})

const viewPermission = function (permission) {
    permissionsStore.editingPermission = permission;
    permissionsStore.showPermissionForm = true;
}

const viewRole = function (role) {
    permissionsStore.editingRole = role;
    permissionsStore.showRoleForm = true;
}

</script>