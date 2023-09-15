<template>
    <div class="mt-6">
        <h2 class="text-xl font-semibold leading-tight text-gray-700">Prompts</h2>

        <div class="my-5 py-5 px-3 bg-white rounded-md">
            <PromptFilters />
        </div>

        <div class="py-4">
            <div class="bg-white inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                ID
                            </th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Content
                            </th>
                            <!-- <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Template
                            </th> -->
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Created by
                            </th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Created at
                            </th>
                            <th
                                class="text-center px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="promptStore.prompts" v-for="prompt in promptStore.prompts">
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-nowrap">
                                            {{ prompt.id }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-nowrap">
                                    <td class="td-class text-center">
                                        {{ prompt.content && prompt.content.length > 100 ? prompt.content.substring(0, 100) + '...' :  prompt.content }}
                                    </td>
                                </p>
                            </td>
                            <!-- <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    {{ prompt.template }}
                                </span>
                            </td> -->
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-nowrap">
                                    {{ prompt.createdBy }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-nowrap">
                                    {{ prompt.createdAt ? formatDate(prompt.createdAt) : 'no date' }}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex justify-around">
                                    <a href="#" class="mx-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <button class="mx-2 rounded-md">
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

                <div class="py-5 pr-5">
                    <Pagination 
                        v-if="promptStore.paginationData" 
                        :pagination-data="promptStore.paginationData" 
                        @change-page="promptStore.handlePaginationEvent" 
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import Pagination from '@/Components/Pagination.vue';
import {formatDate} from '@/Services/DateService'
import { usePromptsStore } from '@/Stores/prompts.store'
import PromptFilters from './PromptFilters.vue';

const promptStore = usePromptsStore();

onMounted(async () => {
    promptStore.getPrompts();
})
</script>