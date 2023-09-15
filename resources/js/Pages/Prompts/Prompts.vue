<template>
        <AuthenticatedLayout>
            <div class="py-6">
            
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4">
                    <PromptList />
                </div>
            </div>

        </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PromptList from '@/Pages/Prompts/components/PromptList.vue';



</script>