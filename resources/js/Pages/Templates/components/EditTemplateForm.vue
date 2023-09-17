<template>
    <Modal 
        :show="templatesStore.showTemplateForm"
        @close="templatesStore.closeTemplateModal"
        @confirm="templatesStore.saveTemplate"
    >

        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ templatesStore.editingTemplate?.id ? 'Edit' : 'Create' }} Template</h2>
        </template>
        <template v-slot:content>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <InputLabel for="status" value="Status" class="mb-1" />

                    <DropdownSelect 
                        class="mt-1 block w-full"
                        :options="[{value: 1, label: 'Active'}, { value: 2, label: 'Draft' }, { value: 3, label: 'Archived' }]" 
                        v-model="templatesStore.editingTemplate.status"  />
                </div>
                <div>
                    <InputLabel for="useLocation" value="Location to use this template" />

                    <DropdownSelect 
                        class="mt-1 block w-full"
                        :options="[{ value: 1, label: 'Cover Letters' }, { value: 2, label: 'Resumes' }]" 
                        v-model="templatesStore.editingTemplate.use_location" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="content" value="Content *" />

                    <TextInput
                        required
                        id="content"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.content"
                    />
                </div>
                <div v-if="templatesStore.editingTemplate?.createdBy">
                    <InputLabel for="createdBy" value="Created By" />

                    <TextInput
                        disabled
                        id="createdBy"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.createdBy"
                    />
                </div>
                <div v-if="templatesStore.editingTemplate?.createdAt">
                    <InputLabel class="mb-1" for="createdAt" value="Created At" />

                    <TextInput
                        disabled
                        id="createdAt"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.createdAt"
                    />
                </div>
                <div v-if="templatesStore.editingTemplate?.updatedBy">
                    <InputLabel for="updatedBy" value="Updated By" />

                    <TextInput
                        disabled
                        id="updatedBy"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.updatedBy"
                    />
                </div>
                <div v-if="templatesStore.editingTemplate?.updatedAt">
                    <InputLabel class="mb-1" for="updatedAt" value="Updated At" />

                    <TextInput
                        disabled
                        id="updatedAt"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.updatedAt"
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
import DropdownSelect from '@/Components/DropdownSelect.vue';
import { useTemplatesStore } from '@/Stores/templates.store'

const templatesStore = useTemplatesStore();

</script>