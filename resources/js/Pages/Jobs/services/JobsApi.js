import ApiService from '@/Services/ApiService';


export default class JobsApi extends ApiService {

    constructor(...args) {
        super(...args);
    }

    static make() {
        return new JobsApi(this.BASE_URL, `jobs`, this.VERSION)
    }

    getJobs(payload) {
        return this.axios.get(`/`, { params: { payload } })
    }

    getRecommendedJobs(payload) {
        return this.axios.get(`/recommended-jobs`, { params: { payload } })
    }

    getApplications(payload) {
        return this.axios.get(`/applications`, { params: { payload } })
    }

    createJob(payload) {
        return this.axios.post(`/`, payload)
    }

    updateJob(JobId, payload) {
        return this.axios.patch(`/${JobId}`, payload)
    }

    deleteJob(JobId, payload) {
        return this.axios.delete(`/${JobId}`, payload)
    }

    quickApply(jobId) {
        return this.axios.get(`/${jobId}/quick-apply`)
    }

}