<template>
    <AuthenticatedLayout>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="rounded-t-lg">
                <div class="profile-cover w-full h-48"
                    style="background: url('/assets/company-image.jpg') no-repeat; background-size: cover; background-position: center;">
                </div>
                <div class="bg-white grid grid-cols-3 pb-4 pr-4 pl-4 sm:pb-8 sm:pr-8 sm:pl-8 shadow rounded-b-lg">
                    <div class="col-1">
                        <div>
                            <img class="max-h-36 max-w-36 rounded-xl -mt-16" src="/assets/logo.jpg" alt="profile image" />
                        </div>

                        <div class="my-5 bg-white">
                            <h3 class="h3 text-xl">
                                {{ entity.name }}
                            </h3>
                            <h3 class="h3 text-slate-600">
                                Software Development
                            </h3>
                        </div>
                    </div>
                    <div class="py-5 h-full flex items-start flex-col align-middle justify-center">
                        <p><strong>Phone:</strong> 0412 345 678 </p>
                        <p><strong>Email:</strong> info@webartisan.io </p>
                        <p><strong>Website:</strong> https://webartisan.io</p>
                    </div>
                    <div class="col-1 py-5 h-full flex items-start flex-col align-middle justify-center">
                        <p><strong>Employees:</strong> {{ entity.employees }}</p>
                        <p><strong>Primary Location:</strong> 8607 Thompson Corners Apt. 988 Port Montana, SD 62599-3371</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4">

            <div>
                <CounterWidget :number="5" text="Applications Received Today" />
            </div>

            <div>
                <CounterWidget :number="23" text="New Job Seekers in your Industry" />
            </div>

            <div>
                <CounterWidget :number="9" text="Potential Candidates Matching your Job Ads" />
            </div>

            <div>
                <div class="bg-white p-5 rounded-md">
                    <div class="flex flex-row justify-between mb-6">
                        <h3 class="h3 text-xl">Manage Listings</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div class="grid space-y-5">
                        <div v-for="(job, index) in entity.jobs" :key="index" class="col-1">
                            <div class="flex justify-between">
                                <div class="flex mb-3">
                                    <div class="text-sm text-slate-700">
                                        <h3 class="h3 text-lg">{{ job.role }}</h3>
                                        <p>{{ job.title }}</p>
                                        <p>{{ job.industry }}</p>
                                    </div>
                                </div>
                                <IconEdit @click="console.log('here')" />
                            </div>
                            <hr v-if="entity.jobs.length > 1 && index + 1 !== entity.jobs.length" class="border-t-2 my-5 border-slate-300">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white p-5 rounded-md">
                    <div class="flex flex-row justify-between mb-6">
                        <h3 class="h3 text-xl">Contacts</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div class="grid space-y-5">
                        <div v-for="(contact, index) in entity.contacts" :key="index" class="col-1">
                            <div class="flex justify-between">
                                <div class="flex mb-3">
                                    <button
                                        class="mr-3 relative z-10 block w-10 h-10 overflow-hidden rounded-full shadow focus:outline-none">
                                        <img class="object-cover w-full h-full"
                                            src="/assets/profile-image-placeholder.jpg"
                                            alt="Your avatar">
                                    </button>
                                    <div class="text-sm text-slate-700">
                                        <h3 class="h3 text-lg">{{ contact.name }}</h3>
                                        <p>{{ contact.position }}</p>
                                        <p class="text-xs mb-1">{{ contact.phone }}</p>
                                        <p class="text-xs mb-1">{{ contact.email }}</p>
                                    </div>
                                </div>
                                <IconEdit @click="console.log('here')" />
                            </div>
                            <hr v-if="entity.contacts.length > 1 && index + 1 !== entity.contacts.length" class="border-t-2 my-5 border-slate-300">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-white p-5 rounded-md">
                    <div class="flex flex-row justify-between mb-6">
                        <h3 class="h3 text-xl">Locations</h3>
                        <SecondaryButton @click="console.log('here')">Create</SecondaryButton>
                    </div>
                    <div v-for="(location, index) in entity.locations" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex mb-3">
                                <div class="text-sm text-slate-700">
                                    <h3 class="h3 text-lg">{{ location.name }}</h3>
                                    <p class="text-xs mb-1">{{ location.location.country }}</p>
                                    <p class="text-xs mb-1">{{ location.location.address }}</p>
                                </div>
                            </div>
                            <IconEdit @click="console.log('here')" />
                        </div>
                        <hr v-if="entity.jobs.length > 1 && index + 1 !== entity.jobs.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import IconEdit from '@/Components/IconEdit.vue';
import CounterWidget from '@/Components/DashboardWidgets/CounterWidget.vue';

const entity = usePage().props.entity.data;


</script>