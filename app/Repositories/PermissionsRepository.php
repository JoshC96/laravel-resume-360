<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsRepository
{

    /**
     * @param string $name 
     * @param string|null $guard 
     * @return Permission 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     * @throws PermissionAlreadyExists 
     * @throws MassAssignmentException 
     */
    public function createPermission(string $name, ?string $guard = null): Permission
    {
        return Permission::create([
            'name' => $name,
            'guard_name' => $guard
        ]);
    }

    /**
     * @param Permission $permission 
     * @param string $name 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updatePermission(Permission $permission, string $name): bool
    {
        $permission->fill(['name' => $name]);
        return $permission->save();
    }


    /**
     * @param string $name 
     * @param array $permissions
     * @return Permission
     */
    public function createRole(string $name, array $permissions = null, ?string $guard = null): Role
    {
        $role = Role::create([
            'name' => $name,
            'guard_name' => $guard
        ]);

        if (!is_null($permissions)) {
            $role->syncPermissions($permissions);
        }

        return $role;
    }

    /**
     * @param Role $Role 
     * @param string $name 
     * @param array $permissions
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateRole(Role $role, string $name, array $permissions = null): bool
    {
        $role->fill(['name' => $name]);

        if (!is_null($permissions)) {
            $role->syncPermissions($permissions);
        }

        return $role->save();
    }


    /**
     * @param Role $role 
     * @param array|string $permissions 
     * @return void 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     * @throws InvalidArgumentException 
     */
    public function assignPermissionsToRole(Role $role, array|string $permissions): void
    {
        $role->givePermissionTo($permissions);
    }

    /**
     * @param Role $role 
     * @param array|string $permissions 
     * @return void 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     * @throws InvalidArgumentException 
     */
    public function removePermissionfromRole(Role $role, array|string $permissions): void
    {
        $role->revokePermissionTo($permissions);
    }
}