<template>
    <AuthenticatedLayout>
        <div class="py-6">
            
            <div class="grid grid-cols-3 max-w-7xl mx-auto sm:px-6 lg:px-8 gap-4">
                <div class="col-span-2 p-4 sm:p-8 bg-white shadow sm:rounded-lg"> 

                    <div class="mb-5">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="keywords" value="Keywords" />
                                <TextInput
                                    id="keywords"
                                    type="text"
                                    placeholder="Keywords"
                                    class="mt-1 block w-full"
                                    v-model="keywords"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="location" value="Location" />
                                <TextInput
                                    id="location"
                                    type="text"
                                    placeholder="Location"
                                    class="mt-1 block w-full"
                                    v-model="location"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="industry" value="Industry" />
                                <TextInput
                                    id="industry"
                                    type="text"
                                    placeholder="Industry"
                                    class="mt-1 block w-full"
                                    v-model="industry"
                                    required
                                />
                            </div>
                            <div> 
                                <InputLabel value="Date Listed" />
                                <VueDatePicker v-model="dateListed" range :format="dateListedFormat" />
                            </div>
                            <div>
                                <InputLabel for="salary" value="Salary" />
                                <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">>
                                    <option>$0</option>
                                    <option>$30k - $50k</option>
                                    <option>$50k - $70k</option>
                                    <option>$70k - $100k</option>
                                    <option>$100k - $150k</option>
                                    <option>$150k - $200k</option>
                                    <option>$200k+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div v-for="(job, index) in jobListingStore.jobs" :key="index">
                            <div class="border border-slate-200 shadow rounded-md p-4">
                                <div class="grid grid-cols-2">
                                    <div>
                                        <h3 class="h3 text-xl text-bold">{{ job.role }}</h3>
                                        <h5 class="text-md">{{ job.title }}</h5>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="text-md">{{ job.entity }}</h5>
                                        <h6 class="text-sm">Added {{ job.createdAt }}</h6>
                                    </div>
                                </div>
                                <p class="mt-3">{{ job.description }}</p>
                                <div class="flex justify-end space-x-2">
                                    <PrimaryButton class="mt-6" @click="job.showConfirmation = true" >
                                        Quick Apply
                                        <LoadingSpinner v-if="job.loading" classes="text-white" ></LoadingSpinner>
                                    </PrimaryButton>
                                    <SecondaryButton class="mt-6" @click="console.log('test')" >
                                        View Job
                                    </SecondaryButton>
                                </div>
                            </div>
                            <Modal 
                                :show="job.showConfirmation"
                                @close="job.showConfirmation = false"
                                @confirm="quickApply(job)"
                            >
                                <template v-slot:header>
                                    <h2 class="h2 text-xl">Quick Apply for {{ job.role }}</h2>
                                </template>
                                <template v-slot:content>
                                    <div class="space-y-6">
                                        <div>
                                            <p>By clicking 'Confirm' you confirm that we can generate an application based on your information and this will be shared with the company advertising the role.</p>
                                        </div>
                                    </div>
                                </template>
                            </Modal>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h3 class="h3 text-xl mb-5">Recommended Jobs</h3>
                        <div v-for="(job, index) in jobListingStore.recommendedJobs" :key="index" class="mb-5">
                            <div class="border border-slate-200 shadow rounded-md p-3">
                                <div>
                                    <div>
                                        <h4 class="h3 text-lg text-bold">{{ job.role }}</h4>
                                        <h5 class="text-sm">{{ job.entity }}</h5>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="text-sm">{{ job.location }}</h6>
                                    </div>
                                </div>
                                <p class="mt-3">{{ job.description }}</p>
                                <div class="flex justify-end space-x-2">
                                    <PrimarySmallButton class="mt-3" @click="console.log('test')" >
                                        Apply
                                    </PrimarySmallButton>
                                    <SecondarySmallButton class="mt-3" @click="console.log('test')" >
                                        View
                                    </SecondarySmallButton>
                                </div>
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
import { ref } from 'vue';
import { onMounted } from 'vue';
import { useJobListingStore } from '@/Stores/job-listings.store';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimarySmallButton from '@/Components/PrimarySmallButton.vue';
import SecondarySmallButton from '@/Components/SecondarySmallButton.vue';
import Modal from '@/Components/Modal.vue';
import LoadingSpinner from '@/Components/LoadingSpinner.vue';

const jobListingStore = useJobListingStore();
const dateListed = ref([
    new Date(),
    new Date(),
]);
const keywords = ref('');
const location = ref('');
const industry = ref('');

const dateListedFormat = (date) => {
    const firstDay = date[0].getDate();
    const firstMonth = date[0].getMonth() + 1;
    const firstYear = date[0].getFullYear();

    const secondDay = date[1].getDate();
    const secondMonth = date[1].getMonth() + 1;
    const secondYear = date[1].getFullYear();

    return `${firstDay}/${firstMonth}/${firstYear} - ${secondDay}/${secondMonth}/${secondYear}`;
}

onMounted(async () => {
    jobListingStore.getJobs();
    jobListingStore.getRecommendedJobs();
})

async function quickApply(job) {
    job.showConfirmation = true;
    job.loading = true;
    const { data } = await jobListingStore.quickApply(job.id);
    job.loading = false;
    job.showConfirmation = false;
}

</script>