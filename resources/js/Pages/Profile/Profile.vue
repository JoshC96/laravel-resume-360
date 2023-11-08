<template>
    <AuthenticatedLayout>
        <div class="py-6">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="rounded-t-lg">
                    <div class="profile-cover w-full h-48"
                        style="background: url('/assets/working-on-website.jpg') no-repeat; background-size: cover; background-position: center;">
                    </div>
                    <div class="bg-white grid grid-cols-1 lg:grid-cols-3 pb-4 pr-4 pl-4 sm:pb-8 sm:pr-8 sm:pl-8 shadow rounded-b-lg">
                        <div class="col-1">
                            <div>
                                <img class="max-h-36 max-w-36 rounded-xl -mt-16" src="/assets/image4.jpg" alt="profile image" />
                            </div>

                            <div class="my-5 bg-white">
                                <h3 class="h3 text-lg lg:text-xl">
                                    {{ user.name }}
                                </h3>
                                <p class="text-md lg:text-lg">
                                    {{ user.currentRole }}Software Engineer
                                </p>
                                <p class="text-md lg:text-lg">
                                    {{ user.location }}
                                    Adelaide, South Australia
                                </p>
                            </div>
                            <SecondaryButton>See Contact Details</SecondaryButton>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-1 py-5 h-full flex items-start flex-col align-middle justify-center">
                            <h2 class="h2 text-lg lg:text-xl mb-4">Profile Visibility</h2>

                            <label class="flex align-middle items-center mb-2">
                                <p class="mr-3 text-md lg:text-lg">Share with Recruiters</p>
                                <Checkbox :value="true" :checked="true"></Checkbox>
                            </label>

                            <label class="flex align-middle items-center">
                                <p class="mr-3 text-md lg:text-lg">Share with Companies</p>
                                <Checkbox :value="true" :checked="true"></Checkbox>
                            </label>
                            <PrimaryButton class="mt-5">Save</PrimaryButton>
                        </div>

                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 space-y-4 lg:space-y-0 lg:space-x-4">
                <div class="col-span-2 space-y-4">


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-5">Bio</h1>
                        <TextAreaInput :rows="5" class="mb-5" v-model="profileStore.bio"></TextAreaInput>
                        <PrimaryButton @click="profileStore.saveBio">Update</PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Referees</h1>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                            <div v-for="(referee, index) in profileStore.referees" :key="index" class="mb-5 col-1">
                                <div class="flex justify-between">
                                    <div class="flex  mb-3">
                                        <button
                                            class="mr-3 relative z-10 block w-10 h-10 overflow-hidden rounded-full shadow focus:outline-none">
                                            <img class="object-cover w-full h-full"
                                                src="/assets/profile-image-placeholder.jpg"
                                                alt="Your avatar">
                                        </button>
                                        <div class="text-sm text-slate-700">
                                            <h3 class="h3 text-lg">{{ referee.name }}</h3>
                                            <p>{{ referee.position }} at {{ referee.entity }}</p>
                                        </div>
                                    </div>
                                    <IconEdit @click="profileStore.triggerEditRefereeForm(referee)" />
                                </div>
                                <p class="text-md mb-3">{{ referee.description }}</p>
                            </div>
                            <EditRefereeForm />
                        </div>
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddRefereeForm()">Add New</PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Work Experience</h1>
                        <div v-for="(experienceItem, index) in profileStore.workExperiences" :key="index" class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="h3 text-lg mb-1">{{ experienceItem.position }}</h3>
                                <IconEdit @click="profileStore.triggerEditExperienceForm(experienceItem)" />
                            </div>
                            <div class="text-sm text-slate-700 mb-3 space-y-2">
                                <p>{{ experienceItem.entity }}</p>
                                <p>{{ experienceItem.location }}</p>
                                <p> {{ monthNames[experienceItem.started_month] }} {{ experienceItem.started_year }} - {{
                                    monthNames[experienceItem.finished_month] }} {{ experienceItem.finished_year }} </p>
                            </div>
                            <p class="text-sm mb-3" style="white-space: pre-wrap">{{ experienceItem.description }}</p>
                            <hr v-if="profileStore.workExperiences.length > 1 && index + 1 !== profileStore.workExperiences.length"
                                class="border-t-2 my-5 border-slate-300">
                        </div>
                        <EditExperienceForm />
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddExperienceForm()">Add New</PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Education</h1>
                        <div v-for="(qualification, index) in profileStore.qualifications" :key="index" class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="h3 text-lg mb-1">{{ qualification.name }}</h3>
                                <IconEdit @click="profileStore.triggerEditQualificationForm(qualification)" />
                            </div>
                            <div class="text-sm text-slate-700 mb-3 space-y-2">
                                <p>{{ qualification.entity }}</p>
                                <p>{{ qualification.location }}</p>
                                <p>{{ qualification.startedAt }} - {{ qualification.finishedAt }} </p>
                            </div>
                            <p class="text-md mb-3">{{ qualification.description }}</p>
                            <hr v-if="profileStore.qualifications.length > 1 && index + 1 !== profileStore.qualifications.length"
                                class="border-t-2 my-5 border-slate-300">
                        </div>
                        <EditQualificationForm />
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddQualificationForm()">Add New
                        </PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Publications</h1>
                        <div v-for="(publication, index) in profileStore.publications" :key="index" class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="h3 text-lg mb-1">{{ publication.name }}</h3>
                                <IconEdit @click="profileStore.triggerEditPublicationForm(publication)" />
                            </div>
                            <div class="text-sm text-slate-700 mb-3 space-y-2">
                                <p>{{ publication.entity }}</p>
                                <p>{{ publication.location }}</p>
                                <p>{{ publication.publishedAt }} </p>
                            </div>
                            <p class="text-md mb-3">{{ publication.description }}</p>
                            <hr v-if="profileStore.publications.length > 1 && index + 1 !== profileStore.publications.length"
                                class="border-t-2 my-5 border-slate-300">
                        </div>
                        <EditPublicationForm />
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddPublicationForm()">Add New
                        </PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Certifications</h1>
                        <div v-for="(certification, index) in profileStore.certifications" :key="index" class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="h3 text-lg mb-1">{{ certification.name }}</h3>
                                <IconEdit @click="profileStore.triggerEditCertificationForm(certification)" />
                            </div>
                            <div class="text-sm text-slate-700 mb-3 space-y-2">
                                <p>{{ certification.entity }}</p>
                                <p>{{ certification.location }}</p>
                                <p> {{ certification.issuedAt }} </p>
                            </div>
                            <p class="text-md mb-3">{{ certification.description }}</p>
                            <hr v-if="profileStore.certifications.length > 1 && index + 1 !== profileStore.certifications.length"
                                class="border-t-2 my-5 border-slate-300">
                        </div>
                        <EditCertificationForm />
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddCertificationForm()">Add New
                        </PrimaryButton>
                    </div>


                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h1 class="h1 text-2xl mb-6">Licences</h1>
                        <div v-for="(licence, index) in profileStore.licences" :key="index" class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="h3 text-lg mb-1">{{ licence.name }}</h3>
                                <IconEdit @click="profileStore.triggerEditLicenceForm(licence)" />
                            </div>
                            <div class="text-sm text-slate-700 mb-3 space-y-2">
                                <p>{{ licence.entity }}</p>
                                <p>{{ licence.location }}</p>
                                <p> {{ licence.startedAt }} - {{ licence.finishedAt }} </p>
                            </div>
                            <p class="text-md mb-3">{{ licence.description }}</p>
                            <hr v-if="profileStore.licences.length > 1 && index + 1 !== profileStore.licences.length"
                                class="border-t-2 my-5 border-slate-300">
                        </div>
                        <EditLicenceForm />
                        <PrimaryButton class="mt-6" @click="profileStore.triggerAddLicenceForm()">Add New</PrimaryButton>
                    </div>
                </div>


                <div class="col-span-1">
                    <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h3 class="h3 text-xl mb-5">Recent Job Applications</h3>
                        <div v-for="(application, index) in jobStore.applications" :key="index" class="mb-5">
                            <div class="border border-slate-200 shadow rounded-md p-3">
                                <div>
                                    <div>
                                        <h4 class="h3 text-lg text-bold">{{ application.role }}</h4>
                                        <h5 class="text-sm">{{ application.entity }}</h5>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="text-sm">{{ application.status }}</h6>
                                    </div>
                                </div>
                                <p class="mt-3"></p>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import IconEdit from '@/Components/IconEdit.vue';
import { usePage } from "@inertiajs/vue3";
import { onMounted } from 'vue';
import EditRefereeForm from './components/EditRefereeForm.vue'
import EditExperienceForm from './components/EditExperienceForm.vue';
import { monthNames } from '@/Services/DateService';
import { useUserProfileStore } from '@/Stores/user-profile.store.js';
import { useJobApplicationStore } from '@/Stores/job-application.store';
import EditQualificationForm from './components/EditQualificationForm.vue';
import EditPublicationForm from './components/EditPublicationForm.vue';
import EditCertificationForm from './components/EditCertificationForm.vue';
import EditLicenceForm from './components/EditLicenceForm.vue';

const profileStore = useUserProfileStore();
const jobStore = useJobApplicationStore();
const user = usePage().props.auth.user;

onMounted(async () => {
    profileStore.getProfile();
    jobStore.getApplications();
})

</script>