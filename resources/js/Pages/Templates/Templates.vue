<template>
        <AuthenticatedLayout>
            <div class="py-6">
            
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4">
                    <TemplateList />
                </div>
            </div>

        </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TemplateList from '@/Pages/Templates/components/TemplateList.vue';
</script>