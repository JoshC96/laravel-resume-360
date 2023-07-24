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
                    <TextAreaInput :model-value="bio" class="mb-5"></TextAreaInput>
                    <PrimaryButton>Update</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Referees</h1>
                    <div class="grid grid-cols-3 gap-5">
                        <div v-for="(referee, index) in referees" :key="index" class="mb-5 col-1">
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
                                <IconEdit />
                            </div>
                            <p class="text-md mb-3">{{ referee.description }}</p>
                        </div>
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Work History</h1>
                    <div v-for="(historyItem, index) in workHistoryItems" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ historyItem.position }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ historyItem.entity }}</p>
                            <p>{{ historyItem.location }}</p>
                            <p> {{ historyItem.startedAt }} - {{ historyItem.finishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ historyItem.description }}</p>
                        <hr v-if="workHistoryItems.length > 1 && index + 1 !== workHistoryItems.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Education</h1>
                    <div v-for="(educationItem, index) in education" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ educationItem.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ educationItem.entity }}</p>
                            <p>{{ educationItem.location }}</p>
                            <p>{{ educationItem.startedAt }} - {{ educationItem.finishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ educationItem.description }}</p>
                        <hr v-if="education.length > 1 && index + 1 !== education.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Publications</h1>
                    <div v-for="(publication, index) in publications" :key="index" class="mb-5">
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
                    <h1 class="h1 text-2xl mb-6">Certificates</h1>
                    <div v-for="(certification, index) in certifications" :key="index" class="mb-5">
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
                        <hr v-if="certifications.length > 1 && index + 1 !== certifications.length" class="border-t-2 my-5 border-slate-300">
                    </div>
                    <PrimaryButton class="mt-6">Add New</PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h1 class="h1 text-2xl mb-6">Licenses</h1>
                    <div v-for="(license, index) in licenses" :key="index" class="mb-5">
                        <div class="flex justify-between">
                            <h3 class="h3 text-lg mb-1">{{ license.name }}</h3>
                            <IconEdit />
                        </div>
                        <div class="text-sm text-slate-700 mb-3 space-y-2">
                            <p>{{ license.entity }}</p>
                            <p>{{ license.location }}</p>
                            <p> {{ license.startedAt }} - {{ license.finishedAt }} </p>
                        </div>
                        <p class="text-md mb-3">{{ license.description }}</p>
                        <hr v-if="licenses.length > 1 && index + 1 !== licenses.length" class="border-t-2 my-5 border-slate-300">
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
import ApiService from '@/Services/ApiService';
import { onMounted } from 'vue';

const api = ApiService.make();
const showContactDetailsModal = ref(false);
const bio = ref('');

const workHistoryItems = ref([{
    name: 'test name 123',
    description: 'As a Senior Sales Representative at John Hopkins Ltd in Windsor Gardens, South Australia, from June 2020 to December 2022, I thrived in a dynamic role that involved building strong client relationships, surpassing sales targets, and leading a motivated sales team. My proactive approach to market analysis and product launches helped strengthen the company\'s position in the industry.I cherish the enriching experiences and valuable skills gained during this rewarding chapter of my career.',
    position: 'Senior Sales Representative',
    entity: 'John Hopkins Ltd',
    startedAt: 'June 2020',
    finishedAt: 'Dec 2022',
    location: 'Windsor Gardens, South Australia',
}, {
    description: '',
    position: 'Software Engineer',
    entity: 'SolarReviews',
    startedAt: 'Apr 2023',
    finishedAt: 'Present',
    location: 'Adelaide, South Australia',
}, {
    description: 'Technical project management, team lead, driving delivery of software solutions with engineers and customers ',
    position: 'Delivery Engineer and Unit Lead',
    entity: 'FOUR',
    startedAt: 'Sep 2020',
    finishedAt: 'Dec 2022',
    location: 'Adelaide, South Australia',
}, {
    description: '',
    position: 'Software Engineer',
    entity: 'Karmabunny',
    startedAt: 'Jan 2023',
    finishedAt: 'Apr 2020',
    location: 'Norwood, South Australia',
}, {
    description: 'This course is designed to be very fast paced and covers many topics including Bootstrap, JavaScript, NodeJS, ReactJS, MySQL, MongoDB, and much more.',
    position: 'Teaching Assistant',
    entity: 'University of Adelaide',
    startedAt: 'Feb 2020',
    finishedAt: 'Jul 2020',
    location: 'Adelaide, South Australia',
}]);

const education = ref([{
    name: 'Bachelors Degree in Sofware Development',
    startedAt: 'Feb 2013',
    finishedAt: 'June 2017',
    description: '',
    field: 'Sofware Development',
    location: 'Christchurch, New Zealand'
}]);
const certifications = ref([{
    name: 'ISC2',
    issuedAt: 'June 2019',
    description: 'CSSLP certification recognizes leading application security skills.',
    location: 'Sydney, New South Wales'
}]);
const licenses = ref([]);
const publications = ref([{
    name: 'The phosphoinositide signature guides the final step of plant cytokinesis',
    publishedAt: 'June 2023',
    description: 'Plant cytokinesis, which fundamentally differs from that in animals, requires the outward expansion of a plasma membrane precursor named the cell plate. How the transition from a cell plate to a plasma membrane occurs remains poorly understood.',
    location: 'Brisbane, Queensland'
}]);
const referees = ref([{
    name: 'Ben Broad',
    position: 'Facilitator',
    entity: 'FOUR',
    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt enim rerum perspiciatis reprehenderit debitis dicta sed nemo.',
},{
    name: 'Rhys Moult',
    position: 'Director',
    entity: 'RMTA',
    description: 'Excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
},{
    name: 'Jesse Castle',
    position: 'Operations Manager',
    entity: 'FOUR',
    description: 'Excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
},{
    name: 'Gwilyn Saunders',
    position: 'CTO',
    entity: 'Karmabunny',
    description: 'Nam excepturi doloremque voluptatum dolore recusandae incidunt fugiat assumenda, at natus distinctio neque?',
}]);


onMounted(() => {
    console.log(api.getUserReferees());
})

</script>