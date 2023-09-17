<template>
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
                <DateRangeInput 
                    :date-value="dateListed" 
                    @update-date-range="dateListed = $event" 
                />
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
</template>

<script setup>
import { ref } from 'vue';
import { useJobListingStore } from '@/Stores/job-listings.store';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import DateRangeInput from '@/Components/DateRangeInput.vue';

const jobListingStore = useJobListingStore();

const dateListed = ref([
    new Date(),
    new Date(),
]);
const keywords = ref('');
const location = ref('');
const industry = ref('');


</script>