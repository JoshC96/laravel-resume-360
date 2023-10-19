<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsRepository
{

    /**
     * @param string $name 
     * @return Permission
     */
    public function createPermission(string $name): Permission
    {
        return Permission::create(['name' => $name]);
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
     * @return Permission
     */
    public function createRole(string $name): Role
    {
        return Role::create(['name' => $name]);
    }

    /**
     * @param Role $Role 
     * @param string $name 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateRole(Role $role, string $name): bool
    {
        $role->fill(['name' => $name]);
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