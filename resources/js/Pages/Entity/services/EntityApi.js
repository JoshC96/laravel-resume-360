import ApiService from '@/Services/ApiService';


export default class EntityApi extends ApiService {

    constructor(...args) {
        super(...args);
    }

    static make() {
        return new EntityApi(this.BASE_URL, `entities`, this.VERSION)
    }

    register(payload) {
        return this.axios.get(`/register`, { params: payload })
    }

    getEntities(payload) {
        return this.axios.get(`/`, { params: payload })
    }

    createEntity(payload) {
        return this.axios.post(`/`, payload)
    }

    updateEntity(entityId, payload) {
        return this.axios.patch(`/${entityId}`, payload)
    }

    deleteEntity(entityId, payload) {
        return this.axios.delete(`/${entityId}`, payload)
    }
}