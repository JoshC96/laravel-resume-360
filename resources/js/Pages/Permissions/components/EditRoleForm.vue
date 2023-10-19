<template>
    <Modal 
        :show="permissionsStore.showRoleForm"
        @close="permissionsStore.closeRoleModal"
        @confirm="permissionsStore.saveRole"
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
            </div>
        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal.vue';
import { usePermissionsStore } from '@/Stores/permissions.store';

const permissionsStore = usePermissionsStore();


</script>