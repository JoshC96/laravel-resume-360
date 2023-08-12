import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import ProfileApi from "@/Pages/Profile/services/ProfileApi";


export const useUserProfileStore = defineStore('userProfileStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = ProfileApi.make();
    const bio = ref('');
    const licences = ref([]);
    const workExperiences = ref([]);
    const qualifications = ref([]);
    const certifications = ref([]);
    const publications = ref([]);
    const referees = ref([]);

    const showRefereeModal = ref(false);
    const editingReferee = ref({});

    const showExperienceModal = ref(false);
    const editingExperience = ref({});
    
    
    async function getProfile() {
        const { data } = await api.getProfile();
        const profile = data.resp.profile;

        bio.value = profile.bio;
        licences.value = profile.licences;
        workExperiences.value = profile.workExperiences;
        qualifications.value = profile.qualifications;
        certifications.value = profile.certifications;
        publications.value = profile.publications;
        referees.value = profile.referees;
    }

    async function saveReferee() {
        if (editingReferee?.id) {
            const { data } = await api.createReferee(editingReferee)

            if (data.resp?.referee) {
                userFlashStore.showSuccess('Added a new referee')
                closeModal();
            } else {
                userFlashStore.reportError('Error creating referee, please try again later')
            }
        } else {
            const { data } = await api.updateReferee(editingReferee.id, editingReferee)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated referee')
                closeModal();
            } else {
                userFlashStore.reportError('Error updating referee, please try again later')
            }
        }
    }

    async function saveExperience() {

        editingExperience.started_month = startedAt.value.month;
        editingExperience.started_year = startedAt.value.year;
        editingExperience.finished_month = finishedAt.value.month;
        editingExperience.finished_year = finishedAt.value.year;

        if (editingExperience?.id) {
            api.updateWorkExperience(editingExperience?.id, editingExperience).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated work experience');
                } else {
                    userFlashStore.reportError('Error updating new work experience');
                }
            }).finally(() => {
                closeModal()
            })
        } else {
            api.createWorkExperience(editingExperience).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New work experience added');
                } else {
                    userFlashStore.reportError('Error creating new work experience');
                }
            }).finally(() => {
                closeModal()
            })
        }
    }

    function triggerEditRefereeForm(referee) {
        editingReferee.value = { ...referee };
        showRefereeModal.value = true
    }

    function triggerAddRefereeForm() {
        showRefereeModal.value = true
    }

    function closeRefereeModal() {
        editingReferee.value = {};
        showRefereeModal.value = false
    }

    function triggerEditExperienceForm(referee) {
        editingExperience.value = { ...referee };
        showExperienceModal.value = true
    }

    function triggerAddExperienceForm() {
        showExperienceModal.value = true
    }

    function closeExperienceModal() {
        editingExperience.value = {};
        showExperienceModal.value = false
    }

    return {
        api, 
        bio,
        licences,
        workExperiences,
        qualifications,
        certifications,
        publications,
        referees,
        showRefereeModal,
        editingReferee,
        showExperienceModal,
        editingExperience,
        getProfile,
        saveExperience,
        saveReferee,
        triggerEditRefereeForm,
        triggerAddRefereeForm,
        closeRefereeModal,
        triggerEditExperienceForm,
        triggerAddExperienceForm,
        closeExperienceModal
    }
}, { 
    persist: false
})