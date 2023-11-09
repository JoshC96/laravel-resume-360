import axios from "axios";
import { usePage } from "@inertiajs/vue3";

export default class ApiService {

    static BASE_URL = 'api';
    static VERSION = 1;
    static BASE_ENDPOINTS = {
        DEFAULT: '',
        USER: 'users',
        JOBS: 'jobs',
        COMPANIES: 'companies',
    };

    constructor(baseUrl, baseEndpoint, version) {
        this.bearer = null;
        this.userId = usePage().props.auth.user.data.id;
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
        return new ApiService(this.BASE_URL, this.BASE_ENDPOINTS.DEFAULT, this.VERSION)
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
}