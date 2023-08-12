<template>
    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div class="bg-white"> 
                    <div class="profile-cover w-full h-48 shadow rounded-t-lg" 
                        style="background: url('/assets/working-on-website.jpg') no-repeat; background-size: cover; background-position: center;">
                    </div>
                    <div class="grid grid-cols-3 pb-4 pr-4 pl-4 sm:pb-8 sm:pr-8 sm:pl-8 shadow rounded-b-lg">
                        <div class="col-1">
                            <div>
                                <img class="max-h-36 max-w-36 rounded-xl -mt-16" src="/assets/image4.jpg" alt="profile image" />
                            </div>

                            <div class="my-5 bg-white">
                                <h3 class="h3 text-xl">
                                    Josh Campbell
                                </h3>
                                <p>
                                    Software Engineer
                                </p>
                                <p>
                                    Adelaide, South Australia
                                </p>
                            </div>
                            <SecondaryButton>See Contact Details</SecondaryButton>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-1 py-5 h-full flex items-start flex-col align-middle justify-center">
                            <h2 class="h2 text-2xl mb-4">Profile Visibility</h2>

                            <label class="flex align-middle items-center mb-2">
                                <p class="mr-3">Share with Recruiters</p>
                                <Checkbox :value="true" :checked="true"></Checkbox>
                            </label>
                            
                            <label class="flex align-middle items-center">
                                <p class="mr-3">Share with Companies</p>
                                <Checkbox :value="true" :checked="true"></Checkbox>
                            </label>
                            <PrimaryButton class="mt-5">Save</PrimaryButton>
                        </div>

                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-5">Bio</h1>
                    <TextAreaInput
                        class="mb-5"
                        v-model="profileStore.bio"
                    ></TextAreaInput>
                    <PrimaryButton @click="profileStore.saveBio">Update</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Referees</h1>
                    <div class="grid grid-cols-3 gap-5">
                        <div v-for="(referee, index) in profileStore.referees" :key="index" class="mb-5 col-1">
                            <div class="flex justify-between">
                                <div class="flex  mb-3">
                                    <button class="mr-3 relative z-10 block w-12 h-12 overflow-hidden rounded-full shadow focus:outline-none">
                                        <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80" alt="Your avatar">
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
                    <PrimaryButton class="mt-6" @click="profileStore.triggerAddRefereeForm()" >Add New</PrimaryButton>
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
                            <p> {{ monthNames[experienceItem.started_month] }} {{ experienceItem.started_year }} - {{ monthNames[experienceItem.finished_month] }} {{ experienceItem.finished_year }} </p>
                        </div>
                        <p class="text-md mb-3">{{ experienceItem.description }}</p>
                        <hr v-if="profileStore.workExperiences.length > 1 && index + 1 !== profileStore.workExperiences.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <EditExperienceForm />
                    <PrimaryButton class="mt-6" @click="profileStore.triggerAddExperienceForm()">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Education</h1>
                    <div v-for="(qualification, index) in profileStore.qualifications" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ qualification.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ qualification.entity }}</p>
                            <p>{{ qualification.location }}</p>
                            <p>{{ qualification.startedAt }} - {{ qualification.finishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ qualification.description }}</p>
                        <hr v-if="profileStore.qualifications.length > 1 && index + 1 !== profileStore.qualifications.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Publications</h1>
                    <div v-for="(publication, index) in profileStore.publications" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ publication.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ publication.entity }}</p>
                            <p>{{ publication.location }}</p>
                            <p>{{ publication.publishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ publication.description }}</p>
                        <hr v-if="publications.length > 1 && index + 1 !== publications.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Certifications</h1>
                    <div v-for="(certification, index) in profileStore.certifications" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ certification.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ certification.entity }}</p>
                            <p>{{ certification.location }}</p>
                            <p> {{ certification.issuedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ certification.description }}</p>
                        <hr v-if="profileStore.certifications.length > 1 && index + 1 !== profileStore.certifications.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Licences</h1>
                    <div v-for="(licence, index) in profileStore.licences" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ licence.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ licence.entity }}</p>
                            <p>{{ licence.location }}</p>
                            <p> {{ licence.startedAt }} - {{ licence.finishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ licence.description }}</p>
                        <hr v-if="profileStore.licences.length > 1 && index + 1 !== profileStore.licences.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
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
import { ref } from 'vue';
import ProfileApi from './services/ProfileApi';
import { onMounted } from 'vue';
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import EditRefereeForm from './components/EditRefereeForm.vue'
import EditExperienceForm from './components/EditExperienceForm.vue';
import { monthNames } from '@/Services/DateService';
import { useUserProfileStore } from '@/Stores/user-profile.store.js';


const userFlashStore = useUserFlashesStore();
const api = ProfileApi.make();
const profileStore = useUserProfileStore();

onMounted(async () => {
    profileStore.getProfile();
})


// const workExperienceItems = ref([{
//     name: 'test name 123',
//     description: 'As a Senior Sales Representative at John Hopkins Ltd in Windsor Gardens, South Australia, from June 2020 to December 2022, I thrived in a dynamic role that involved building strong client relationships, surpassing sales targets, and leading a motivated sales team. My proactive approach to market analysis and product launches helped strengthen the company\'s position in the industry.I cherish the enriching experiences and valuable skills gained during this rewarding chapter of my career.',
//     position: 'Senior Sales Representative',
//     entity: 'John Hopkins Ltd',
//     startedAt: 'June 2020',
//     finishedAt: 'Dec 2022',
//     location: 'Windsor Gardens, South Australia',
// }, {
//     description: '',
//     position: 'Software Engineer',
//     entity: 'SolarReviews',
//     startedAt: 'Apr 2023',
//     finishedAt: 'Present',
//     location: 'Adelaide, South Australia',
// }, {
//     description: 'Technical project management, team lead, driving delivery of software solutions with engineers and customers ',
//     position: 'Delivery Engineer and Unit Lead',
//     entity: 'FOUR',
//     startedAt: 'Sep 2020',
//     finishedAt: 'Dec 2022',
//     location: 'Adelaide, South Australia',
// }, {
//     description: '',
//     position: 'Software Engineer',
//     entity: 'Karmabunny',
//     startedAt: 'Jan 2023',
//     finishedAt: 'Apr 2020',
//     location: 'Norwood, South Australia',
// }, {
//     description: 'This course is designed to be very fast paced and covers many topics including Bootstrap, JavaScript, NodeJS, ReactJS, MySQL, MongoDB, and much more.',
//     position: 'Teaching Assistant',
//     entity: 'University of Adelaide',
//     startedAt: 'Feb 2020',
//     finishedAt: 'Jul 2020',
//     location: 'Adelaide, South Australia',
// }]);

// const education = ref([{
//     name: 'Bachelors Degree in Sofware Development',
//     startedAt: 'Feb 2013',
//     finishedAt: 'June 2017',
//     description: '',
//     field: 'Sofware Development',
//     location: 'Christchurch, New Zealand'
// }]);
// const certifications = ref([{
//     name: 'ISC2',
//     issuedAt: 'June 2019',
//     description: 'CSSLP certification recognizes leading application security skills.',
//     location: 'Sydney, New South Wales'
// }]);
// const licences = ref([]);
// const publications = ref([{
//     name: 'The phosphoinositide signature guides the final step of plant cytokinesis',
//     publishedAt: 'June 2023',
//     description: 'Plant cytokinesis, which fundamentally differs from that in animals, requires the outward expansion of a plasma membrane precursor named the cell plate. How the transition from a cell plate to a plasma membrane occurs remains poorly understood.',
//     location: 'Brisbane, Queensland'
// }]);
// const referees = ref([{
//     name: 'Ben Broad',
//     position: 'Facilitator',
//     entity: 'FOUR',
//     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt enim rerum perspiciatis reprehenderit debitis dicta sed nemo.',
// }, {
//     name: 'Rhys Moult',
//     position: 'Director',
//     entity: 'RMTA',
//     description: 'Excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
// }, {
//     name: 'Jesse Castle',
//     position: 'Operations Manager',
//     entity: 'FOUR',
//     description: 'Excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
// }, {
//     name: 'Gwilyn Saunders',
//     position: 'CTO',
//     entity: 'Karmabunny',
//     description: 'Nam excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
// }]);

</script>