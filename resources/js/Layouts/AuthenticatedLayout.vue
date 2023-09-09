<template>
    <div>
        <div class="flex h-screen bg-gray-200 font-roboto">

            <Sidebar />

            <div class="flex-1 flex flex-col overflow-hidden">
                <Header />

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        <slot />
                    </div>

                    <UserFlash />

                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '@/Sidebar';
import Header from '@/Layouts/Components/Header';
import UserFlash from './Components/UserFlash.vue';
</script>