<template>
    <Modal 
        :show="permissionsStore.showRoleForm"
        @close="closeModal"
        @confirm="saveRole"
    >

        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ permissionsStore.editingRole?.id ? 'Edit' : 'Create' }} Role</h2>
        </template>
        <template v-slot:content>
            <div class="grid gap-5">
                <div>
                    <InputLabel for="name" value="Name" class="mb-1" />

                    <TextInput
                        required
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="permissionsStore.editingRole.name"
                    />
                </div>
                <div>
                    <InputLabel for="permissions" value="Assign Permissions" class="mb-1" />

                    <Multiselect 
                        v-if="permissionOptions"
                        v-model="permissionsStore.editingRole.permissions" 
                        :options="permissionOptions" 
                        mode="tags"
                        optionLabel="name" 
                        placeholder="Select Permissions For Role"
                        :clearOnSelect="false"
                        :closeOnSelect="false"
                        :closeOnDeselect="false"
                        class="w-full md:w-20rem"> </Multiselect>
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal.vue';
import { usePermissionsStore } from '@/Stores/permissions.store';
import Multiselect from '@vueform/multiselect';
import { onMounted, ref } from 'vue';


const permissionsStore = usePermissionsStore();
const permissionOptions = ref();

if (permissionsStore.editingRole?.permission) {
    permissionsStore.editingRole.permissions = [];
}

onMounted(async function () {
    if (permissionsStore.permissions?.length === 0) {
        await permissionsStore.getPermissions();
        permissionOptions.value = permissionsStore.permissions.map(permission => permission.name)
    }
});

const saveRole = function () {
    permissionsStore.saveRole();
}

const closeModal = function () {
    permissionsStore.closeRoleModal();
}


</script>