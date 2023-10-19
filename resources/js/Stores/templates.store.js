import { defineStore } from "pinia";
import { reactive, ref } from "vue";
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';
import TemplatesApi from "@/Services/TemplatesApi";

export const useTemplatesStore = defineStore('templatesStore', () => {
    const userFlashStore = useUserFlashesStore();
    const api = TemplatesApi.make();
    const templates = ref();
    const paginationData = ref();
    const editingTemplate = ref({});
    const showTemplateForm = ref(false);
    
    async function getTemplates(page = 1, perPage) {
        const { data } = await api.getTemplates({ page: page, per_page: perPage });
        templates.value = data.resp.templates_paginated.data;
        paginationData.value = data.resp.templates_paginated;
    }

    async function handlePaginationEvent(newPageUrl) {
        getTemplates(newPageUrl.newPage, newPageUrl.perPage);
    }

    async function deleteTemplate(templateId) {
        if (templateId) {
            const { data } = await api.deleteTemplate(templateId)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Deleted template')
                getTemplates();
            } else {
                userFlashStore.reportError('Error deleting template, please try again later')
            }
        } else {
            userFlashStore.reportError('A template ID is required.')
        }
    }


    async function saveTemplate() {
        if (editingTemplate.value.id) {
            const { data } = await api.updateTemplate(editingTemplate.value.id, editingTemplate.value)

            if (data.resp?.status) {
                userFlashStore.showSuccess('Updated template')
                closeTemplateModal();
                getTemplates();
            } else {
                userFlashStore.reportError('Error updating template, please try again later')
            }
        } else {
            const { data } = await api.createTemplate(editingTemplate.value)

            if (data.resp?.template) {
                userFlashStore.showSuccess('Added a new template')
                closeTemplateModal();
                getTemplates();
            } else {
                userFlashStore.reportError('Error creating template, please try again later')
            }
        }
    }

    function triggerEditTemplateForm(template) {
        editingTemplate.value = { ...template };
        showTemplateForm.value = true
    }

    function closeTemplateModal() {
        showTemplateForm.value = false
        editingTemplate.value = {};
    }


    return {
        api, 
        templates,
        paginationData,
        editingTemplate,
        showTemplateForm,
        getTemplates,
        handlePaginationEvent,
        saveTemplate,
        triggerEditTemplateForm,
        closeTemplateModal,
        deleteTemplate
    }
})