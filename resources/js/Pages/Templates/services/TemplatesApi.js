import ApiService from '@/Services/ApiService';


export default class TemplatesApi extends ApiService {

    constructor(...args) {
        super(...args);
    }

    static make() {
        return new TemplatesApi(this.BASE_URL, `templates`, this.VERSION)
    }

    getTemplates(payload) {
        return this.axios.get(`/`, { params: payload })
    }

    createTemplate(payload) {
        return this.axios.post(`/`, payload)
    }

    updateTemplate(templateId, payload) {
        return this.axios.patch(`/${templateId}`, payload)
    }

    deleteTemplate(templateId, payload) {
        return this.axios.delete(`/${templateId}`, payload)
    }

}