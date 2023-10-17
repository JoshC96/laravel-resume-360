<template>
    <div class="flex">
        <!-- Backdrop -->
        <div :class="isOpen ? 'block' : 'hidden'" @click="isOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <!-- End Backdrop -->

        <div :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="justify-between fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex h-100 flex-col">

                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center justify-center align-center">
                        <svg class="w-12 h-12 ml-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" data-name="Layer 1" viewBox="0 0 45 52.5">
                            <path
                                d="M41.51,27a18,18,0,0,1-.23,2.32,16.12,16.12,0,0,1-.57,2.25,14.68,14.68,0,0,1-.88,2.13,16.89,16.89,0,0,1-1.19,2,15.47,15.47,0,0,1-7.11,5.53,15.24,15.24,0,0,1-8.83.64,15,15,0,0,1-7.58-4.32,14.74,14.74,0,0,1-3.83-7.66,14.94,14.94,0,0,1-.09-4.29,16.81,16.81,0,0,1,.42-2.09,13.93,13.93,0,0,1,.73-2,14.28,14.28,0,0,1,5.44-6.26,14,14,0,0,1,1.84-1,13.27,13.27,0,0,1,1.95-.69,15.33,15.33,0,0,1,2-.39,14.73,14.73,0,0,1,2-.09v2.72l8-4.61-8-4.62v2.6a21.62,21.62,0,0,0-2.54.25,20,20,0,0,0-2.54.63,18.68,18.68,0,0,0-2.4,1,17.15,17.15,0,0,0-2.22,1.33,17.39,17.39,0,0,0-7,10.41,17.33,17.33,0,0,0-.37,5,18.9,18.9,0,0,0,.36,2.49,17.06,17.06,0,0,0,1.8,4.66A18.37,18.37,0,0,0,12.08,37a16.67,16.67,0,0,0,3.58,3.4,16.17,16.17,0,0,0,2.11,1.27,16.69,16.69,0,0,0,2.27.94,16.1,16.1,0,0,0,2.37.59,16.51,16.51,0,0,0,9.5-1.16A16.32,16.32,0,0,0,39,35.9a16.79,16.79,0,0,0,1.12-2.09A17.77,17.77,0,0,0,41,31.59,16.15,16.15,0,0,0,41.51,27Z" />
                        </svg>

                        <span class="mx-2 text-2xl font-semibold text-white">Resume360</span>
                    </div>
                </div>

                <nav class="mt-10">
                    <p class="pl-4 text-xs font-semibold mb-4 text-gray-400 uppercase">Jobs</p>
                    <!-- <Link 
                    :href="route('dashboard')"
                    class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                    :class="[route().current('dashboard') ? activeClass : inactiveClass]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>

                    <span class="mx-4">Dashboard</span>
                </Link> -->
                
                    <Link 
                        :href="route('jobs')"
                        class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                        :class="[route().current('jobs') ? activeClass : inactiveClass]" >
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 3C6.44772 3 6 3.44772 6 4C6 4.55228 6.44772 5 7 5H13C13.5523 5 14 4.55228 14 4C14 3.44772 13.5523 3 13 3H7Z" fill="currentColor" />
                            <path d="M4 7C4 6.44772 4.44772 6 5 6H15C15.5523 6 16 6.44772 16 7C16 7.55228 15.5523 8 15 8H5C4.44772 8 4 7.55228 4 7Z" fill="currentColor" />
                            <path d="M2 11C2 9.89543 2.89543 9 4 9H16C17.1046 9 18 9.89543 18 11V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V11Z" fill="currentColor" />
                        </svg>

                        <span class="mx-4">Jobs</span>
                    </Link>

                    <p class="pl-4 mt-5 text-xs font-semibold mb-4 text-gray-400 uppercase">Profile</p>

                    <Link 
                        :href="route('profile')"
                        class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                        :class="[route().current('profile') ? activeClass : inactiveClass]" >
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z" fill="currentColor" />
                            <path d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z" fill="currentColor" />
                            <path d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z" fill="currentColor" />
                            <path d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z" fill="currentColor" />
                        </svg>

                        <span class="mx-4">Profile</span>
                    </Link>

                    <p v-if="entityStore.userEntities.length > 0" class="pl-4 mt-5 text-xs font-semibold mb-4 text-gray-400 uppercase">Entities</p>

                    <div v-for="entity in entityStore.userEntities">
                        <Link 
                            :href="route('entity', entity.id)"
                            class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                            :class="[route().current('entity', entity.id) ? activeClass : inactiveClass]" >
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z" fill="currentColor" />
                                <path d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z" fill="currentColor" />
                                <path d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z" fill="currentColor" />
                                <path d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z" fill="currentColor" />
                            </svg>

                            <span class="mx-4">{{ entity.name }}</span>
                        </Link>
                    </div>

                    <p class="pl-4 mt-5 text-xs font-semibold mb-4 text-gray-400 uppercase">Admin</p>

                    <Link 
                        :href="route('prompts')"
                        class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                        :class="[route().current('prompts') ? activeClass : inactiveClass]" >
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z" fill="currentColor" />
                            <path d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z" fill="currentColor" />
                            <path d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z" fill="currentColor" />
                            <path d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z" fill="currentColor" />
                        </svg>

                        <span class="mx-4">AI Prompts</span>
                    </Link>

                    <Link 
                        :href="route('templates')"
                        class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                        :class="[route().current('templates') ? activeClass : inactiveClass]" >
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z" fill="currentColor" />
                            <path d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z" fill="currentColor" />
                            <path d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z" fill="currentColor" />
                            <path d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z" fill="currentColor" />
                        </svg>

                        <span class="mx-4">AI Templates</span>
                    </Link>
                </nav>
                <Link 
                    :href="route('entity.registration')"
                    class="absolute bottom-5 left-8 items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                    <span class="mx-4">Advertise a Job</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useSidebarStore } from '@/Stores/sidebar-store.store.js'
import { useEntityStore } from '@/Stores/entity.store.js'
import { Link } from '@inertiajs/vue3';

const { isOpen } = useSidebarStore();
const entityStore = useEntityStore();

const activeClass = ref(
    "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100"
);
const inactiveClass = ref(
    "border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100"
);

entityStore.getUserEntities()



</script>
