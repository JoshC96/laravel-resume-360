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
                    <InputLabel for="createdAt" value="Created At" />

                    <TextInput
                        disabled
                        id="createdAt"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.createdAt"
                    />
                </div>
                <div>
                    <InputLabel for="status" value="Status" />

                    <TextInput
                        id="status"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.status"
                    />
                </div>
                <div>
                    <InputLabel for="useLocation" value="Location to use this template" />

                    <TextInput
                        id="useLocation"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="templatesStore.editingTemplate.use_location"
                    />
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
            </div>
        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal.vue';
import { useTemplatesStore } from '@/Stores/templates.store'

const templatesStore = useTemplatesStore();

</script>