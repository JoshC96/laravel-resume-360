<template>
    <div v-if="promptStore.showPromptForm" class="my-5 py-5 px-3 bg-white rounded-md">

        <div class="flex justify-between items-center mb-8">
            <button class="flex items-center" @click="promptStore.showPromptForm = false">
                <svg fill="#343434" width="40px" height="40px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256,48C141.13,48,48,141.13,48,256s93.13,208,208,208,208-93.13,208-208S370.87,48,256,48Zm35.31,292.69a16,16,0,1,1-22.62,22.62l-96-96a16,16,0,0,1,0-22.62l96-96a16,16,0,0,1,22.62,22.62L206.63,256Z"/></svg>
                <span class="ml-2 text-md"> Return to list </span>
            </button>
            <span>
                Prompt ID: {{promptStore.editingPrompt.id}}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <div>
                <InputLabel for="createdBy" value="Created By" />

                <TextInput
                    disabled
                    id="createdBy"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="promptStore.editingPrompt.createdBy"
                />
            </div>
            <div>
                <InputLabel for="createdAt" value="Created At" />

                <TextInput
                    disabled
                    id="createdAt"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="promptStore.editingPrompt.createdAt"
                />
            </div>
            <div class="col-span-2">
                <InputLabel for="template" value="Template" />

                <TextInput
                    disabled
                    id="template"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="promptStore.editingPrompt.template"
                />
            </div>
            <div>
                <InputLabel for="prompt" value="Prompt" />

                <TextAreaInput
                    :rows="25"
                    disabled
                    id="prompt"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="promptStore.editingPrompt.content"
                />
            </div>
            <div>
                <InputLabel for="response" value="Response" />

                <TextAreaInput
                    :rows="25"
                    disabled
                    id="response"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="promptStore.editingPrompt.response"
                />
            </div>
        </div>
    </div>


</template>

<script setup>
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import TextAreaInput from '@/Components/TextAreaInput';
import { usePromptsStore } from '@/Stores/prompts.store'


const promptStore = usePromptsStore();


</script>