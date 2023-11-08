<template>
    <div class="mt-6">
        <h2 class="text-xl font-semibold leading-tight text-gray-700">Templates</h2>

        <div>
            <div class="flex justify-between items-center my-5 py-5 px-3 bg-white rounded-md">
                <TemplateFilters />
            </div>

            <div class="py-4 overflow-scroll">
                <div class="bg-white inline-block min-w-full overflow-hidden rounded-lg shadow">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    ID
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Status
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Location
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Content
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Updated
                                </th>
                                <th
                                    class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Created
                                </th>
                                <th
                                    class="text-center px-4 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="templatesStore.templates" v-for="template in templatesStore.templates">
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="mx-auto">
                                            <p class="text-gray-900 whitespace-nowrap">
                                                {{ template.id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="mx-auto">
                                            <p class="text-gray-900 whitespace-nowrap">
                                                {{ template.statusName }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="mx-auto">
                                            <p class="text-gray-900 whitespace-nowrap">
                                                {{ template.locationName }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-nowrap">
                                        {{ template.content && template.content.length > 65 ? template.content.substring(0, 65) + '...' : template.content }}
                                    </p>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <!-- <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full" src="" alt="profile pic" />
                                        </div> -->
                                        <div class="mx-auto">
                                            <p class="text-gray-900 whitespace-nowrap">
                                                {{ template.updatedAt ? formatDate(template.updatedAt) : 'no date' }}
                                                <div class="text-xs leading-5 text-gray-500">
                                                    {{ template.updatedBy }}
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <!-- <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full" src="" alt="profile pic" />
                                        </div> -->
                                        <div class="mx-auto">
                                            <p class="text-gray-900 whitespace-nowrap">
                                                {{ template.createdAt ? formatDate(template.createdAt) : 'no date' }}
                                                <div class="text-xs leading-5 text-gray-500">
                                                    {{ template.createdBy }}
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm bg-white border-b border-gray-200">
                                    <div class="flex justify-around">
                                        <button class="mx-2 rounded-md" @click="templatesStore.triggerEditTemplateForm(template)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="mx-2 rounded-md" @click="templatesStore.deleteTemplate(template.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>     
                    
                    
                    <EditTemplateForm />

                    <div class="py-5 pr-5">
                        <Pagination 
                            v-if="templatesStore.paginationData" 
                            :pagination-data="templatesStore.paginationData" 
                            @change-page="templatesStore.handlePaginationEvent" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import Pagination from '@/Components/Pagination';
import {formatDate} from '@/Services/DateService'
import { useTemplatesStore } from '@/Stores/templates.store'
import TemplateFilters from './TemplateFilters';
import EditTemplateForm from './EditTemplateForm'

const templatesStore = useTemplatesStore();

onMounted(async () => {
    templatesStore.getTemplates();
})

</script>