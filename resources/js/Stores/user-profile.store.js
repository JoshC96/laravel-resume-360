import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import ProfileApi from "@/Pages/Profile/services/ProfileApi";


export const useUserProfileStore = defineStore('userProfileStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = ProfileApi.make();
    const bio = ref('');
    const referees = ref([]);
    const workExperiences = ref([]);
    const qualifications = ref([]);
    const licences = ref([]);
    const certifications = ref([]);
    const publications = ref([]);

    const showRefereeModal = ref(false);
    const editingReferee = ref({});

    const showExperienceModal = ref(false);
    const editingExperience = ref({});

    const showQualificationModal = ref(false);
    const editingQualification = ref({});

    const showPublicationModal = ref(false);
    const editingPublication = ref({});

    const showLicenceModal = ref(false);
    const editingLicence = ref({});

    const showCertificationModal = ref(false);
    const editingCertification = ref({});

    
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


    async function saveBio() {
        const { data } = await api.updateBio(bio.value)

        if (data.resp?.status) {
            userFlashStore.showSuccess('Updated bio')
        } else {
            userFlashStore.reportError('Error updating bio, please try again later')
        }
    }

    async function saveReferee() {
        if (editingReferee.value.id) {
            const { data } = await api.updateReferee(editingReferee.value.id, editingReferee.value)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated referee')
                closeRefereeModal();
                getProfile();
            } else {
                userFlashStore.reportError('Error updating referee, please try again later')
            }
        } else {
            const { data } = await api.createReferee(editingReferee.value)

            if (data.resp?.referee) {
                userFlashStore.showSuccess('Added a new referee')
                closeRefereeModal();
                getProfile();
            } else {
                userFlashStore.reportError('Error creating referee, please try again later')
            }
        }
    }

    async function saveExperience() {

        if (editingExperience.value?.id) {
            api.updateWorkExperience(editingExperience.value.id, editingExperience.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated work experience');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error updating work experience');
                }
            }).catch(() => {
                userFlashStore.reportError('Error updating work experience');
            }).finally(() => {
                closeExperienceModal()
            })
        } else {
            api.createWorkExperience(editingExperience.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New work experience added');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error creating new work experience');
                }
            }).catch(() => {
                userFlashStore.reportError('Error creating work experience');
            }).finally(() => {
                closeExperienceModal()
            })
        }
    }


    async function saveQualification() {

        if (editingQualification.value?.id) {
            api.updateQualification(editingQualification.value.id, editingQualification.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated qualification');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error updating qualification');
                }
            }).catch(() => {
                userFlashStore.reportError('Error updating qualification');
            }).finally(() => {
                closeQualificationModal()
            })
        } else {
            api.createQualification(editingQualification.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New qualification added');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error creating new qualification');
                }
            }).catch(() => {
                userFlashStore.reportError('Error creating new qualification');
            }).finally(() => {
                closeQualificationModal()
            })
        }
    }

    async function savePublication() {

        if (editingPublication.value?.id) {
            api.updatePublication(editingPublication.value.id, editingPublication.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated publication');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error updating qualification');
                }
            }).catch(() => {
                userFlashStore.reportError('Error updating qualification');
            }).finally(() => {
                closePublicationModal()
            })
        } else {
            api.createPublication(editingPublication.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New publication added');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error creating new publication');
                }
            }).catch(() => {
                userFlashStore.reportError('Error creating new publication');
            }).finally(() => {
                closePublicationModal()
            })
        }
    }

    async function saveLicence() {

        if (editingLicence.value?.id) {
            api.updateLicence(editingLicence.value.id, editingLicence.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated licence');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error updating licence');
                }
            }).catch(() => {
                userFlashStore.reportError('Error updating licence');
            }).finally(() => {
                closeLicenceModal()
            })
        } else {
            api.createLicence(editingLicence.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New licence added');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error creating new licence');
                }
            }).catch(() => {
                userFlashStore.reportError('Error creating licence');
            }).finally(() => {
                closeLicenceModal()
            })
        }
    }

    async function saveCertification() {

        if (editingCertification.value?.id) {
            api.updateCertification(editingCertification.value.id, editingCertification.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('Updated certification');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error updating certification');
                }
            }).catch(() => {
                userFlashStore.reportError('Error updating certification');
            }).finally(() => {
                closeCertificationModal()
            })
        } else {
            api.createCertification(editingCertification.value).then(function (resp) {
                if (resp.status) {
                    userFlashStore.showSuccess('New certification added');
                    getProfile();
                } else {
                    userFlashStore.reportError('Error creating new certification');
                }
            }).catch(() => {
                userFlashStore.reportError('Error creating certification');
            }).finally(() => {
                closeCertificationModal()
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

    function triggerEditQualificationForm(qualification) {
        editingQualification.value = { ...qualification };
        showQualificationModal.value = true
    }

    function triggerAddQualificationForm() {
        showQualificationModal.value = true
    }

    function closeQualificationModal() {
        editingQualification.value = {};
        showQualificationModal.value = false
    }

    function triggerEditPublicationForm(publication) {
        editingPublication.value = { ...publication };
        showPublicationModal.value = true
    }

    function triggerAddPublicationForm() {
        showPublicationModal.value = true
    }

    function closePublicationModal() {
        editingPublication.value = {};
        showPublicationModal.value = false
    }

    function triggerEditLicenceForm(licence) {
        editingLicence.value = { ...licence };
        showLicenceModal.value = true
    }

    function triggerAddLicenceForm() {
        showLicenceModal.value = true
    }

    function closeLicenceModal() {
        editingLicence.value = {};
        showLicenceModal.value = false
    }

    function triggerEditCertificationForm(certification) {
        editingCertification.value = { ...certification };
        showCertificationModal.value = true
    }

    function triggerAddCertificationForm() {
        showCertificationModal.value = true
    }

    function closeCertificationModal() {
        editingCertification.value = {};
        showCertificationModal.value = false
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
        showQualificationModal,
        editingQualification,
        showPublicationModal,
        editingPublication,
        showLicenceModal,
        editingLicence,
        showCertificationModal,
        editingCertification,
        getProfile,
        saveBio,
        saveExperience,
        saveReferee,
        saveQualification,
        savePublication,
        saveLicence,
        saveCertification,
        triggerEditRefereeForm,
        triggerAddRefereeForm,
        closeRefereeModal,
        triggerEditExperienceForm,
        triggerAddExperienceForm,
        closeExperienceModal,
        triggerEditQualificationForm,
        triggerAddQualificationForm,
        closeQualificationModal,
        triggerEditPublicationForm,
        triggerAddPublicationForm,
        closePublicationModal,
        triggerEditLicenceForm,
        triggerAddLicenceForm,
        closeLicenceModal,
        triggerEditCertificationForm,
        triggerAddCertificationForm,
        closeCertificationModal
    }
}, { 
    persist: false
})