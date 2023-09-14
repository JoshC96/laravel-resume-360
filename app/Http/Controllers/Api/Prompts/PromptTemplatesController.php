<?php

namespace App\Http\Controllers\Api\Prompts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Prompts\DestroyPromptRequest;
use App\Http\Requests\Prompts\StorePromptRequest;
use App\Http\Requests\Prompts\UpdatePromptRequest;
use App\Http\Resources\Prompts\PromptTemplateResource;
use App\Models\PromptTemplate;
use App\Repositories\PromptTemplateRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PromptTemplatesController extends ApiController
{

    public function __construct(
        Request $request,
        protected PromptTemplateRepository $templateRepository
    ) {
        parent::__construct($request);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getTemplates(Request $request): JsonResponse
    {
        return $this->formatResponse([
            'templates_paginated' => PromptTemplate::query()
                ->paginate(
                    $data['per_page'] ?? 20,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($jobListing) => new PromptTemplateResource($jobListing))
        ]);
    }

    /**
     * @param StoreRefereeRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createTemplate(StorePromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'prompt' => $this->templateRepository->createPromptTemplate($data)
        ]);
    }

    /**
     * @param PromptTemplate $template 
     * @param UpdatePromptRequest $request 
     * @return JsonResponse 
     */
    public function updateTemplate(PromptTemplate $template, UpdatePromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->templateRepository->updatePromptTemplate($template, $data)
        ]);
    }

    /**
     * @param PromptTemplate $template
     * @param DestroyPromptRequest $request 
     * @return JsonResponse 
     */
    public function deleteTemplate(PromptTemplate $template, DestroyPromptRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $template->delete()
        ]);
    }
}
