import ApiService from '@/Services/ApiService';



export default class UserApi extends ApiService {

    constructor(...args){
        super(...args);
    }

    static make() {
        return new UserApi(this.BASE_URL, `user`, this.VERSION)
    }    

    getUsers(payload) {
        return this.axios.get(`/`, { params: payload })
    }

    createUser(payload) {
        return this.axios.post(`/`, payload)
    }

    updateUser(userId, payload) {
        return this.axios.patch(`/${userId}`, payload)
    }

    deleteUser(userId, payload) {
        return this.axios.delete(`/${userId}`, payload)
    }

    getProfile() {
        return this.axios.get(`/profile`)
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
        return this.axios.delete(`/referees/${refereeId}`, payload)
    }

    getBio() {
        return this.axios.get(`/bio`)
    }

    updateBio(bioContent) {
        return this.axios.patch(`/`, { bio: bioContent })
    }

    getWorkExperience() {
        return this.axios.get(`/work-experiences`)
    }

    createWorkExperience(payload) {
        return this.axios.post(`/work-experiences`, payload)
    }

    updateWorkExperience(workExperienceId, payload) {
        return this.axios.patch(`/work-experiences/${workExperienceId}`, payload)
    }

    deleteWorkExperience(workExperienceId, payload) {
        return this.axios.patch(`/work-experiences/${workExperienceId}`, payload)
    }

    getEducation() {
        return this.axios.get(`/qualifications`)
    }

    createQualification(payload) {
        return this.axios.post(`/qualifications`, payload)
    }

    updateQualification(qualificationId, payload) {
        return this.axios.patch(`/qualifications/${qualificationId}`, payload)
    }

    deleteQualification(qualificationId, payload) {
        return this.axios.patch(`/qualifications/${qualificationId}`, payload)
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

    getCertifications() {
        return this.axios.get(`/certifications`)
    }

    createCertification(payload) {
        return this.axios.post(`/certifications`, payload)
    }

    updateCertification(certificationId, payload) {
        return this.axios.patch(`/certifications/${certificationId}`, payload)
    }

    deleteCertification(certificationId, payload) {
        return this.axios.patch(`/certifications/${certificationId}`, payload)
    }

    
    getLicences() {
        return this.axios.get(`/licences`)
    }

    createLicence(payload) {
        return this.axios.post(`/licences`, payload)
    }

    updateLicence(licenceId, payload) {
        return this.axios.patch(`/licences/${licenceId}`, payload)
    }

    deleteLicence(licenceId, payload) {
        return this.axios.patch(`/licences/${licenceId}`, payload)
    }


}