import { defineStore } from "pinia";
import { ref } from "vue";
import JobsApi from "@/Services/JobsApi";

const slideComponents = [
    'ConfirmQuickApply',
    'EditCoverLetter',
    'ContactDetails',
    'ReviewApplication',
]

export const useQuickApplyFlowStore = defineStore('quickApplyFlowStore', () => {
    const api = JobsApi.make();
    const application = ref({
        jobId: null,
        jobRole: null,
        entityName: null,
        applicantName: null,
        applicantEmail: null,
        applicantPhone: null,
        coverLetter: null,
        userEditedCoverLetter: false
    })

    const loading = ref(false);
    const showQuickApplication = ref(false);
    const errorMessage = ref('');
    const currentSlide = ref(slideComponents[0]);
    const slides = ref(slideComponents);
    const showReview = ref(true);

    function initializeFlow(job) {
        application.value.jobId = job.id;
        application.value.jobRole = job.role;
        application.value.entityName = job.entity;
        showQuickApplication.value = true;
    }

    async function generateCoverLetter() {
        loading.value = true;
        const { data } = await api.generateCoverLetter(application.value.jobId);
        application.value.coverLetter = data.resp.coverLetter;
        loading.value = false;
    }

    async function quickApply() {
        return await api.quickApply(application.value);
    }

    function nextSlide(slide = null) {
        if(slide) {
            currentSlide.value = slides.value[slide]
        } else {
            currentSlide.value = slides.value[slides.value.indexOf(currentSlide.value) + 1];
        }
    }

    function completeApplication() {
        showReview.value = false;
        setTimeout(() => {
            cancelQuickApply();
        }, 2000);
    }

    function cancelQuickApply() {
        loading.value = false;
        showQuickApplication.value = false;
        errorMessage.value = '';
        currentSlide.value = slideComponents[0];

        Object.assign(application.value, {
            jobId: null,
            jobRole: null,
            entityName: null,
            applicantName: null,
            applicantEmail: null,
            applicantPhone: null,
            coverLetter: null,
            userEditedCoverLetter: false
        });
    }

    return {
        api,
        application,
        loading,
        showQuickApplication,
        errorMessage,
        currentSlide,
        slides,
        showReview,
        quickApply,
        generateCoverLetter,
        nextSlide,
        cancelQuickApply,
        initializeFlow,
        completeApplication
    }
})