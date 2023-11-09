import { usePage } from "@inertiajs/vue3";

export default class PermissionsService  { 

    constructor() {
        this.userRoles = usePage().props.auth.user.data.roles;
        this.userPermissions = usePage().props.auth.user.data.permissions;
    }

    userHasPermission(permission) {
        return this.userPermissions.includes(permission) ?? false;
    }

    userHasRole(role) {
        return this.userRoles.includes(role) ?? false;
    }

    canManageUsers() {
        return this.userRoles.includes('admin') || this.userRoles.includes('provider');
    }

}