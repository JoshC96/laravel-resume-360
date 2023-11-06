<template>
    <div>
        <div class="py-12">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-8">User Management</h2>
            <div class="max-w-8xl mx-auto">
                <div class="p-4 bg-white inline-block min-w-full overflow-hidden rounded-lg shadow">
                    <div class="flex flex-row justify-between mb-6">
                        <h2 class="h2 text-lg">Users</h2>
                        <!-- <PrimaryButton @click.stop="usersStore.triggerEditUserForm">Create</PrimaryButton> -->
                    </div>
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Roles
                                </th>
                                <th
                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Registered At
                                </th>
                                <th
                                    class="text-center px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="usersStore.users" v-for="user in usersStore.users">
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ user.id }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ user.name }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ user.email }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        <span v-for="(role, index) in user.roles">
                                            {{ role.name }}{{ user.roles.length > 1 && index + 1 !== user.roles.length ? ', ' : '' }}
                                        </span>
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ user.created_at ? formatDate(user.created_at) : 'no date' }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="flex lg:w-1/2 mx-auto justify-around">
                                        <button class="mx-2 rounded-md" @click="viewUser(user)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="mx-2 rounded-md" @click="impersonateUser(user.uuid)" >
                                            <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 21L22 18M22 18L19 15M22 18H16M12 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5Z"/>
                                            </svg>
                                        </button>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <EditUserForm />

            </div>
        </div>
    </div>
</template>

<script setup>
import { useUserManagementStore } from '@/Stores/user-management.store';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { formatDate } from '@/Services/DateService'
import EditUserForm from '@/Modules/EditUserForm.vue'

const usersStore = useUserManagementStore();
usersStore.getUsers();

const viewUser = function (user) {
    usersStore.editingUser = user;
    usersStore.showUserEditModal = true;
}

const impersonateUser = function (uuid) {
    usersStore.impersonateUser(uuid)
}

</script>