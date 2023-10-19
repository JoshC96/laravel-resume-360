<?php

namespace App\Http\Controllers\Api\Permissions;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Permissions\StorePermissionRequest;
use App\Http\Requests\Permissions\StoreRoleRequest;
use App\Http\Requests\Permissions\UpdatePermissionRequest;
use App\Http\Requests\Permissions\UpdateRoleRequest;
use App\Http\Requests\Referee\DestroyPermissionRequest;
use App\Http\Requests\Referee\DestroyRoleRequest;
use App\Repositories\PermissionsRepository;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionsController extends ApiController
{

    public function __construct(
        Request $request,
        protected PermissionsRepository $repository
    ) {
        parent::__construct($request);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getPermissions(Request $request): JsonResponse
    {
        return $this->formatResponse([
            'permissions' => Permission::all()
        ]);
    }

    /**
     * @param StorePermissionRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createPermission(StorePermissionRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'permission' => $this->repository->createPermission($data[StorePermissionRequest::REQUEST_NAME])
        ]);
    }

    /**
     * @param Permission $permission 
     * @param UpdatePermissionRequest $request 
     * @return JsonResponse 
     */
    public function updatePermission(Permission $permission, UpdatePermissionRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->repository->updatePermission($permission, $data[UpdatePermissionRequest::REQUEST_NAME])
        ]);
    }

    /**
     * @param Permission $permission
     * @param DestroyPermissionRequest $request 
     * @return JsonResponse 
     */
    public function deletePermission(Permission $permission, DestroyPermissionRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $permission->delete()
        ]);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getRoles(Request $request): JsonResponse
    {
        return $this->formatResponse([
            'roles' => Role::all()
        ]);
    }


    /**
     * @param StoreRoleRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createRole(StoreRoleRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'role' => $this->repository->createRole($data[StoreRoleRequest::REQUEST_NAME])
        ]);
    }

    /**
     * @param Role $role 
     * @param UpdateRoleRequest $request 
     * @return JsonResponse 
     */
    public function updateRole(Role $role, UpdateRoleRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->repository->updateRole($role, $data[UpdateRoleRequest::REQUEST_NAME])
        ]);
    }

    /**
     * @param Role $role 
     * @param DestroyPermissionRequest $request 
     * @return JsonResponse 
     */
    public function deleteRole(Role $role, DestroyRoleRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $role->delete()
        ]);
    }
}
