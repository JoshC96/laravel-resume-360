import axios from "axios";


const BASE_URL = 'api';
const VERSION = 1;
const BASE_ENDPOINTS = {
    DEFAULT: '',
    USER: 'users',
    JOBS: 'jobs',
    COMPANIES: 'companies',
};

export default class ApiService {

    constructor(baseUrl, baseEndpoint, version) {
        this.bearer = null;
        this.userId = null;
        this.baseUrl = baseUrl;
        this.baseEndpoint = baseEndpoint;
        this.version = version;
    }

    _notImplemented(name) {
        throw new Error(`Function ${name} is not implemented in this ApiClient`);

        return new Promise(resolve => resolve());
    }

    get axios() {        
        return axios.create({
            baseURL: `/${this.baseUrl}/v${this.version}/${this.baseEndpoint}`,
            headers: {
                'X-CLIENT-BEARER' : this.bearer ?? '',
                'Accept': 'application/json'
            }
        });
    }

    setBearer(bearer) {
        this.bearer = bearer;
    }

    setUserId(userId) {
        this.userId = userId;
    }

    static make() {
        return new ApiService(BASE_URL, BASE_ENDPOINTS.DEFAULT, VERSION)
    }

    static getBaseUrl() {
        return BASE_URL;
    }

    static getVerison() {
        return VERSION;
    }

    static getBaseEndpoints() {
        return BASE_ENDPOINTS;
    }

    getUserReferees() {
        this.baseEndpoint = BASE_ENDPOINTS.USER;
        return this.axios.get(`/${this.userId}/referees`)
    }

    createUserReferee(payload) {
        this.baseEndpoint = BASE_ENDPOINTS.USER;
        return this.axios.post(`/${this.userId}/referees`, payload)
    }

    updateUserReferee(refereeId, payload) {
        this.baseEndpoint = BASE_ENDPOINTS.USER;
        return this.axios.patch(`/${this.userId}/referees/${refereeId}`, payload)
    }

}