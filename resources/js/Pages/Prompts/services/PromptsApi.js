import ApiService from '@/Services/ApiService';


export default class PromptsApi extends ApiService {

    constructor(...args) {
        super(...args);
    }

    static make() {
        return new PromptsApi(this.BASE_URL, `prompts`, this.VERSION)
    }

    getPrompts(payload) {
        return this.axios.get(`/`, { params: payload })
    }

    createPrompt(payload) {
        return this.axios.post(`/`, payload)
    }

    updatePrompt(promptId, payload) {
        return this.axios.patch(`/${promptId}`, payload)
    }

    deletePrompt(promptId, payload) {
        return this.axios.delete(`/${promptId}`, payload)
    }

}