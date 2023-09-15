<?php

namespace App\Http\Controllers\Api\Prompts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Prompts\DestroyPromptRequest;
use App\Http\Requests\Prompts\StorePromptRequest;
use App\Http\Requests\Prompts\UpdatePromptRequest;
use App\Http\Resources\Prompts\PromptResource;
use App\Models\Prompt;
use App\Repositories\AiPromptRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PromptsController extends ApiController
{

    public function __construct(
        Request $request,
        protected AiPromptRepository $promptRepository
    ) {
        parent::__construct($request);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getPrompts(Request $request): JsonResponse
    {
        $data = $request->all();

        return $this->formatResponse([
            'prompts_paginated' => Prompt::query()
                ->orderBy(Prompt::CREATED_AT, 'desc')
                ->paginate(
                    $data['per_page'] ?? 20,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($jobListing) => new PromptResource($jobListing))
            
        ]);
    }

    /**
     * @param StoreRefereeRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createPrompt(StorePromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'prompt' => $this->promptRepository->createPrompt($data)
        ]);
    }

    /**
     * @param Prompt $prompt 
     * @param UpdatePromptRequest $request 
     * @return JsonResponse 
     */
    public function updatePrompt(Prompt $prompt, UpdatePromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->promptRepository->updatePrompt($prompt, $data)
        ]);
    }

    /**
     * @param Prompt $prompt
     * @param DestroyPromptRequest $request 
     * @return JsonResponse 
     */
    public function deletePrompt(Prompt $prompt, DestroyPromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $prompt->delete()
        ]);
    }
}
