<template>
    <AuthenticatedLayout>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="rounded-t-lg">
                <div class="profile-cover w-full h-48"
                    style="background: url('/assets/company-image.jpg') no-repeat; background-size: cover; background-position: center;">
                </div>
                <div class="bg-white grid grid-cols-1 lg:grid-cols-3 pb-4 pr-4 pl-4 sm:pb-8 sm:pr-8 sm:pl-8 shadow rounded-b-lg">
                    <div class="col-1">
                        <div>
                            <img class="max-h-36 max-w-36 rounded-xl -mt-16" src="/assets/logo.jpg" alt="profile image" />
                        </div>

                        <div class="my-5 bg-white">
                            <h3 class="h3 text-xl">
                                {{ entity.name }}
                            </h3>
                            <h3 class="h3 text-slate-600">
                                {{ entity.industry }}
                            </h3>
                            <h3 class="text-xs text-slate-600">
                                {{ entity.type }}
                            </h3>
                        </div>
                    </div>
                    <div v-if="entity.phone || entity.email || entity.website" class="py-5 h-full flex items-start flex-col align-middle justify-center">
                        <p v-if="entity.phone" ><strong>Phone:</strong> {{ entity.phone }} </p>
                        <p v-if="entity.email"><strong>Email:</strong> {{ entity.email }} </p>
                        <p v-if="entity.website"><strong>Website:</strong> {{ entity.website }}</p>
                    </div>
                    <div class="col-1 py-5 h-full flex items-start flex-col align-middle justify-center">
                        <p><strong>Employees:</strong> {{ entity.employees ? entity.employees : 0 }}</p>
                        <p><strong>Primary Location:</strong> 8607 Thompson Corners Apt. 988 Port Montana, SD 62599-3371</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4">

            <div>
                <CounterWidget :number="5" text="New Applications Received Today" />
            </div>

            <div>
                <CounterWidget :number="23" text="New Job Seekers in your Industry" />
            </div>

            <div>
                <CounterWidget :number="9" text="Potential Candidates Matching your Job Ads" />
            </div>

        </div>

        <div v-if="entity.type === 'Provider'" class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-8">
            <UserManagement :entity="entity" key="entityUserManagement" />
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4">

            <div>
                <div class="bg-white p-3 rounded-md">
                    <div class="flex flex-row justify-between items-center mb-4">
                        <h3 class="h3 text-lg">Manage Listings</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div class="grid space-y-5">
                        <div v-for="(job, index) in entityStore.entityJobs" :key="index" class="col-1 mt-0">
                            <div class="flex justify-between">
                                <div class="flex mb-1">
                                    <div class="text-slate-700">
                                        <h3 class="h3 text-sm">{{ job.role }}</h3>
                                        <p class="text-xs mb-1">{{ job.title }}</p>
                                        <p class="text-xs mb-1">{{ job.industry }}</p>
                                    </div>
                                </div>
                                <IconEdit @click="console.log('here')" />
                            </div>
                            <hr v-if="entityStore.entityJobs.length > 1 && index + 1 !== entityStore.entityJobs.length" class="border-t-2 my-3 border-slate-300">
                        </div>
                        <Pagination 
                            v-if="entityStore.entityJobsPaginationData" 
                            :per-page="5"
                            :pagination-data="entityStore.entityJobsPaginationData" 
                            @change-page="handleJobsPaginate" 
                        />
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white p-3 rounded-md">
                    <div class="flex flex-row justify-between items-center mb-4">
                        <h3 class="h3 text-lg">Contacts</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div class="grid space-y-5">
                        <div v-for="(contact, index) in entityStore.entityContacts" :key="index" class="col-1 mt-0">
                            <div class="flex justify-between">
                                <div class="flex mb-1">
                                    <button
                                        class="mr-3 relative z-10 block w-7 h-7 overflow-hidden rounded-full shadow focus:outline-none">
                                        <img class="object-cover w-full h-full"
                                            src="/assets/profile-image-placeholder.jpg"
                                            alt="Your avatar">
                                    </button>
                                    <div class="text-slate-700">
                                        <h3 class="h3 text-sm">{{ contact.name }}</h3>
                                        <p class="text-xs mb-1">{{ contact.position }}</p>
                                        <p class="text-xs mb-1">{{ contact.phone }}</p>
                                        <p class="text-xs mb-1">{{ contact.email }}</p>
                                    </div>
                                </div>
                                <IconEdit @click="console.log('here')" />
                            </div>
                            <hr v-if="entityStore.entityContacts.length > 1 && index + 1 !== entityStore.entityContacts.length" class="border-t-2 my-3 border-slate-300">
                        </div>
                        <Pagination 
                            v-if="entityStore.entityContactsPaginationData" 
                            :per-page="5"
                            :pagination-data="entityStore.entityContactsPaginationData" 
                            @change-page="handleContactsPaginate" 
                        />
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-white p-3 rounded-md">
                    <div class="flex flex-row justify-between mb-4">
                        <h3 class="h3 text-lg">Locations</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div v-for="(location, index) in entityStore.entityLocations" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex mb-1">
                                <div class="text-slate-700">
                                    <h3 class="h3 text-sm">{{ location.name }}</h3>
                                    <p class="text-xs mb-1">{{ location.location.country }}</p>
                                    <p class="text-xs mb-1">{{ location.location.address }}</p>
                                </div>
                            </div>
                            <IconEdit @click="console.log('here')" />
                        </div>
                        <hr v-if="entityStore.entityLocations.length > 1 && index + 1 !== entityStore.entityLocations.length" class="border-t-2 my-3 border-slate-300">
                    </div>

                    <Pagination 
                        v-if="entityStore.entityLocationsPaginationData" 
                        :per-page="5"
                        :pagination-data="entityStore.entityLocationsPaginationData" 
                        @change-page="handleLocationsPaginate" 
                    />
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { useEntityStore } from '@/Stores/entity.store.js'
import SecondaryButton from '@/Components/SecondaryButton.vue';
import IconEdit from '@/Components/IconEdit.vue';
import CounterWidget from '@/Components/DashboardWidgets/CounterWidget.vue';
import Pagination from '@/Components/Pagination.vue';
import UserManagement from '@/Modules/UserManagement.vue'

const entity = usePage().props.entity.data;
const entityStore = useEntityStore();
entityStore.getEntityContacts(entity.id);
entityStore.getEntityLocations(entity.id);
entityStore.getEntityJobs(entity.id);

const handleContactsPaginate = function (newPageUrl) {
    entityStore.handleContactPaginationEvent(entity.id, newPageUrl)
}

const handleLocationsPaginate = function (newPageUrl) {
    entityStore.handleLocationPaginationEvent(entity.id, newPageUrl)
}

const handleJobsPaginate = function (newPageUrl) {
    entityStore.handleEntityJobPaginationEvent(entity.id, newPageUrl)
}


</script>