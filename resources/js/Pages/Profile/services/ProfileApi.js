import ApiService from '@/Services/ApiService';



export default class ProfileApi extends ApiService {

    constructor(...args){
        super(...args);
    }

    static make() {
        return new ProfileApi(this.BASE_URL, `profile`, this.VERSION)
    }    

    getProfile() {
        return this.axios.get(`/`)
    }

    updateSettings(payload) {
        return this.axios.post(`/settings`, payload)
    }

    getReferees() {
        return this.axios.get(`/referees`)
    }

    createReferee(payload) {
        return this.axios.post(`/referees`, payload)
    }

    updateReferee(refereeId, payload) {
        return this.axios.patch(`/referees/${refereeId}`, payload)
    }

    deleteReferee(refereeId, payload) {
        return this.axios.patch(`/referees/${refereeId}`, payload)
    }

    getBio() {
        return this.axios.get(`/bio`)
    }

    updateBio(bioContent) {
        return this.axios.patch(`/bio`, { bio: bioContent })
    }

    getWorkHistory() {
        return this.axios.get(`/work-history`)
    }

    createWorkHistory(payload) {
        return this.axios.post(`/work-history`, payload)
    }

    updateWorkHistory(workHistoryId, payload) {
        return this.axios.patch(`/work-history/${workHistoryId}`, payload)
    }

    deleteWorkHistory(workHistoryId, payload) {
        return this.axios.patch(`/work-history/${workHistoryId}`, payload)
    }

    getEducation() {
        return this.axios.get(`/education`)
    }

    createEducation(payload) {
        return this.axios.post(`/education`, payload)
    }

    updateEducation(educationId, payload) {
        return this.axios.patch(`/education/${educationId}`, payload)
    }

    deleteEducation(educationId, payload) {
        return this.axios.patch(`/education/${educationId}`, payload)
    }

    getPublications() {
        return this.axios.get(`/publications`)
    }

    createPublication(payload) {
        return this.axios.post(`/publications`, payload)
    }

    updatePublication(publicationId, payload) {
        return this.axios.patch(`/publications/${publicationId}`, payload)
    }

    deletePublication(publicationId, payload) {
        return this.axios.patch(`/publications/${publicationId}`, payload)
    }

    getCertificates() {
        return this.axios.get(`/certificates`)
    }

    createCertificate(payload) {
        return this.axios.post(`/certificates`, payload)
    }

    updateCertificate(certificateId, payload) {
        return this.axios.patch(`/certificates/${certificateId}`, payload)
    }

    deleteCertificate(certificateId, payload) {
        return this.axios.patch(`/certificates/${certificateId}`, payload)
    }

    
    getLicenses() {
        return this.axios.get(`/licenses`)
    }

    createLicense(payload) {
        return this.axios.post(`/licenses`, payload)
    }

    updateLicense(licenseId, payload) {
        return this.axios.patch(`/licenses/${licenseId}`, payload)
    }

    deleteLicense(licenseId, payload) {
        return this.axios.patch(`/licenses/${licenseId}`, payload)
    }


}