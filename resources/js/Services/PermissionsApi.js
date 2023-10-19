import ApiService from '@/Services/ApiService';


export default class PermissionsApi extends ApiService {

    constructor(...args) {
        super(...args);
    }

    static make() {
        return new PermissionsApi(this.BASE_URL, `permissions`, this.VERSION)
    }

    getPermissions(payload) {
        return this.axios.get(`/`, { params: payload })
    }

    createPermission(payload) {
        return this.axios.post(`/`, payload)
    }

    updatePermission(permissionId, payload) {
        return this.axios.patch(`/${permissionId}`, payload)
    }

    deletePermission(permissionId, payload) {
        return this.axios.delete(`/${permissionId}`, payload)
    }

    getRoles(payload) {
        return this.axios.get(`/roles`, { params: payload })
    }

    createRole(payload) {
        return this.axios.post(`/roles`, payload)
    }

    updateRole(roleId, payload) {
        return this.axios.patch(`/roles/${roleId}`, payload)
    }

    deleteRole(roleId, payload) {
        return this.axios.delete(`/roles/${roleId}`, payload)
    }

}