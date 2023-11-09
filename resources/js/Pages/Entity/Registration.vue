<template>
    <AuthenticatedLayout>

        <div>
            <div class="max-w-2xl mx-auto p-12 rounded-lg bg-white">
                <h2 class="font-semibold mb-12 text-xl text-gray-800 leading-tight">Register to begin showcasing your job opportunities</h2>
                <div class="space-y-6">
                    <div>
                        <InputLabel for="business-name" value="Business Name *" />

                        <TextInput 
                            id="business-name" 
                            type="text" 
                            class="mt-1 block w-full"
                            v-model="store.entity.name" 
                            required />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Business Phone *" />

                        <TextInput 
                            id="phone" 
                            type="text"
                            pattern="\d+"
                            class="mt-1 block w-full"
                            v-model="store.entity.phone" 
                            required />
                    </div>
                    <div>
                        <InputLabel for="email" value="Business Email *" />

                        <TextInput 
                            id="email" 
                            type="email"
                            class="mt-1 block w-full"
                            v-model="store.entity.email" 
                            required />
                    </div>
                    <div>
                        <InputLabel for="industry" value="Industry *" />

                        <TextInput 
                            id="industry" 
                            type="text"
                            class="mt-1 block w-full"
                            v-model="store.entity.industry" 
                            required />
                    </div>
                    <div>
                        <InputLabel for="salary" value="Business Type *" />
                        <DropdownSelect 
                            class="mt-1 block w-full"
                            v-model="store.entity.type"
                            :options="[
                                { value: 1, label: 'Provider' },
                                { value: 2, label: 'Recruiter' },
                                { value: 3, label: 'Small Business' },
                                { value: 4, label: 'Corporation' },
                                { value: 5, label: 'Partnership' },
                                { value: 6, label: 'Non-Profit' },
                                { value: 7, label: 'Government Entity' },
                                { value: 8, label: 'Sole Trader' }
                            ]" 
                        />
                    </div>
                    <div>
                        <InputLabel for="website" value="Website" />

                        <TextInput 
                            id="website" 
                            type="text" 
                            class="mt-1 block w-full"
                            v-model="store.entity.website" 
                            required />
                    </div>
                    <div>
                        <InputLabel for="employees" value="Number of Employees" />

                        <TextInput 
                            id="employees" 
                            type="number"
                            pattern="\d+"
                            class="mt-1 block w-full"
                            v-model="store.entity.employee_size" 
                            required />
                    </div>
                    <div>
                        <button 
                            :disabled="!validEntity"
                            @click.stop="store.register"
                            class="transition duration-100 bg-indigo-500 hover:bg-indigo-400 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6"
                            :class="{ 'opacity-60 pointer-events-none cursor-default ' : !validEntity }">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useTalentRegistrationStore } from '@/Stores/talent-registration.store';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import DropdownSelect from '@/Components/DropdownSelect.vue';
import { ref, watch } from 'vue';

const store = useTalentRegistrationStore();
const validEntity = ref(false);

watch(store.entity, (newVal) => {
    if (newVal.name && newVal.type && newVal.phone) {
        validEntity.value = true;
    }

})

</script>