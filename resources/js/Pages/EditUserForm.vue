<template>
    <Modal 
        :show="usersStore.showUserEditModal"
        @close="usersStore.closeUserModal"
        @confirm="usersStore.saveUser"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ usersStore.editingUser.id ? 'Edit' : 'Create' }} User</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <InputLabel for="name" value="Name *" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="usersStore.editingUser.name"
                        required
                    />
                </div>
                <div class="grid md:grid-cols-2 gap-5"> 
                    <div>
                        <InputLabel for="email" value="Email *" />
            
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="usersStore.editingUser.email"
                            required
                        />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Phone *" />

                        <TextInput
                            id="phone"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="usersStore.editingUser.phone"
                            required
                        />
                    </div>
                    <div>
                        <InputLabel value="Assign Roles" class="mb-1" />

                        <Multiselect 
                            v-if="roleOptions"
                            v-model="selectedRoles" 
                            :options="usersStore.permissions.map(permission => permission.name)" 
                            mode="tags"
                            optionLabel="name" 
                            placeholder="Select Cities"
                            :clearOnSelect="false"
                            :closeOnSelect="false"
                            :closeOnDeselect="false"
                            class="w-full md:w-20rem"> </Multiselect>
                    </div>
                    <div>
                        <InputLabel for="created" value="Registered At" />

                        <TextInput
                            id="created"
                            :disabled="true"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="usersStore.editingUser.created_at"
                        />
                    </div>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Multiselect from '@vueform/multiselect';
import { useUserManagementStore } from '@/Stores/user-management.store';
import { usePermissionsStore } from '@/Stores/permissions.store';

const usersStore = useUserManagementStore();
const permissionsStore = usePermissionsStore();
const selectedRoles = ref([]);
let roleOptions = [];

permissionsStore.getRoles();

watch(selectedRoles, () => {
    usersStore.editingUser.roles = selectedRoles.value
})

watch(permissionsStore.roles, () => {
    roleOptions = permissionsStore.roles.map(role => role.name)
})

</script>