<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\User\Profile\UserProfileRequest;
use App\Http\Resources\User\Profile\UserProfileResource;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     */
    public function getProfile(UserProfileRequest $request): JsonResponse
    {
        $data = $request->collect();

        return $this->formatResponse([
            UserProfileRequest::REQUEST_USER_PROFILE => new UserProfileResource(Auth::user())
        ]);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getReferees(UserProfileRequest $request): JsonResponse
    {
        $data = $request->collect();

        return $this->formatResponse([
            UserProfileRequest::REQUEST_REFEREES => Auth::user()->{User::RELATION_REFEREES}
        ]);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function updateBio(UserProfileRequest $request): JsonResponse
    {
        $data = $request->collect();
        /** @var User $user */
        $user = Auth::user();
        $user->{User::FIELD_BIO} = $data[UserProfileRequest::REQUEST_BIO];

        return $this->formatResponse([
            'status' => $user->save()
        ]);
    }

}