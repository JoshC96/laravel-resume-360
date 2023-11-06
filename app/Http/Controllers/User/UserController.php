<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        protected UserService $userService,
    ) {}

    /**
     * @param string $uuid
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function impersonateUser(string $uuid, Request $request)
    {
        return $this->userService->impersonateUser($uuid);
    }


    /**
     * @param string $uuid
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function stopImpersonateUser(Request $request)
    {
        return $this->userService->stopImpersonateUser();
    }
}
