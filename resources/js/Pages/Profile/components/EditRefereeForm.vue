<template>
    <Modal 
        :show="profileStore.showRefereeModal"
        @close="profileStore.closeRefereeModal"
        @confirm="profileStore.saveReferee"
    >
        <template v-slot:header>
            <h2 class="h2 text-xl"> {{ profileStore.editingReferee.id ? 'Edit' : 'Create' }} Referee</h2>
        </template>
        <template v-slot:content>
            <div class="space-y-6">
                <div>
                    <h3 class="text-md">Your referee's information can only be seen by you and may optionally appear on selected job applications</h3>
                </div>
                <div>
                    <InputLabel for="name" value="Name *" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingReferee.name"
                        required
                    />
                </div>
                <div class="grid md:grid-cols-2 gap-5"> 
                    <div>
                        <InputLabel for="organisation" value="Organisation *" />
            
                        <TextInput
                            id="organisation"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="profileStore.editingReferee.entity"
                            required
                        />
                    </div>
                    <div>
                        <InputLabel for="position" value="Position *" />

                        <TextInput
                            id="position"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="profileStore.editingReferee.position"
                            required
                        />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Phone" />

                        <TextInput
                            id="phone"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="profileStore.editingReferee.phone"
                        />
                    </div>
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="profileStore.editingReferee.email"
                        />
                    </div>
                </div>
                <div>
                    <InputLabel for="description" value="How do you know this person?  *" />

                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="profileStore.editingReferee.description"
                        required
                    />
                </div>
            </div>
        </template>
    </Modal>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import { useUserProfileStore } from '@/Stores/user-profile.store.js';

const profileStore = useUserProfileStore();


</script>