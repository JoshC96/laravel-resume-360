<?php

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getReferees(Request $request): JsonResponse
    {
        return $this->formatResponse([
            'referees' => User::all()
        ]);
    }
}