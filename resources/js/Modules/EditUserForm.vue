<template>
    <Modal 
        :show="usersStore.showUserEditModal"
        @close="usersStore.closeUserModal"
        @confirm="usersStore.saveUser"
    >

        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ usersStore.editingUser?.id ? 'Edit' : 'Create' }} User</h2>
        </template>
        <template v-slot:content>
            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <InputLabel for="name" value="Name" class="mb-1" />

                    <TextInput
                        required
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="usersStore.editingUser.name"
                    />
                </div>
                <div v-if="usersStore.editingUser?.id">
                    <InputLabel for="userId" value="User ID" class="mb-1" />

                    <TextInput
                        :disabled="true"
                        id="userId"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="usersStore.editingUser.id"
                    />
                </div>
                <div>
                    <InputLabel for="email" value="Email" class="mb-1" />

                    <TextInput
                        required
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="usersStore.editingUser.email"
                    />
                </div>
                <div>
                    <InputLabel for="phone" value="Phone" class="mb-1" />

                    <TextInput
                        required
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="usersStore.editingUser.mobile_phone"
                    />
                </div>
            </div>
            <div v-if="showPermissions" class="mt-5">
                <InputLabel value="Assign Roles" class="mb-1" />

                <Multiselect 
                    v-model="selectedRoles" 
                    :options="permissionsStore.roles.map(role => role.name)" 
                    mode="tags"
                    optionLabel="name" 
                    placeholder="Select Roles For User"
                    :clearOnSelect="false"
                    :closeOnSelect="false"
                    :closeOnDeselect="false"
                    class="w-full md:w-20rem"> </Multiselect>
            </div>

            <div v-if="!usersStore.editingUser?.id" class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="usersStore.editingUser.password"
                    required
                    autocomplete="new-password"
                />
            </div>

        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal.vue';
import { useUserManagementStore } from '@/Stores/user-management.store';
import { usePermissionsStore } from '@/Stores/permissions.store';
import Multiselect from '@vueform/multiselect';
import { watch, ref } from 'vue';


const props = defineProps({
    showPermissions: {
        type: Boolean,
        default: false
    },
    entityId: {
        type: Number,
        required: false
    }
});

const usersStore = useUserManagementStore();
const permissionsStore = usePermissionsStore();
const selectedRoles = ref([]);
const roleOptions = ref([]);
permissionsStore.getRoles();

if (props.entityId) {
    usersStore.editingUser.provider_id = props.entityId;
}

watch(selectedRoles, () => {
    usersStore.editingUser.roles = selectedRoles.value;
})

watch(permissionsStore.roles, () => {
    roleOptions.value = permissionsStore.roles.map(role => role.name);
})

</script>