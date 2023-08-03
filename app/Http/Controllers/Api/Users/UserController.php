<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\User\StoreRefereeRequest;
use App\Http\Requests\User\UpdateRefereeRequest;
use App\Http\Requests\User\UserProfileRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;
use App\Models\UserReferee;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use RefereeRepository;

class UserController extends ApiController
{

    public function __construct(Request $request, protected RefereeRepository $refereeRepository)
    {
        parent::__construct($request);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     */
    public function getProfile(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        return $this->formatResponse([
            UserProfileRequest::REQUEST_USER_PROFILE => new UserProfileResource(Auth::user())
        ]);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function updateBio(UserProfileRequest $request): JsonResponse
    {
        $validated = $request->validate([
            UserProfileRequest::REQUEST_BIO => 'string|nullable|max:1000'
        ]);
        /** @var User $user */
        $user = Auth::user();
        $user->{User::FIELD_BIO} = $validated[UserProfileRequest::REQUEST_BIO];

        return $this->formatResponse([
            'status' => $user->save()
        ]);
    }

    /**
     * @param UserProfileRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getReferees(UserProfileRequest $request): JsonResponse
    {
        $data = $request->all();

        return $this->formatResponse([
            UserProfileRequest::REQUEST_REFEREES => Auth::user()->{User::RELATION_REFEREES}
        ]);
    }

    /**
     * @param StoreRefereeRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createReferee(StoreRefereeRequest $request): JsonResponse
    {
        $data = $request->safe()->all();
        $user = Auth::user();

        return $this->formatResponse([
            'referee' => $this->refereeRepository->createUserReferee($user, $data)
        ]);
    }

    /**
     * @param UserReferee $referee 
     * @param UpdateRefereeRequest $request 
     * @return JsonResponse 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     * @throws BindingResolutionException 
     */
    public function updateReferee(UserReferee $referee, UpdateRefereeRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->refereeRepository->updateUserReferee($referee, $data)
        ]);
    }

}