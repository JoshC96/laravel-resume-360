<?php

namespace App\Http\Controllers\Api\Prompts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PromptTemplates\DestroyPromptTemplateRequest;
use App\Http\Requests\PromptTemplates\StorePromptTemplateRequest;
use App\Http\Requests\PromptTemplates\StorePromptTemplatesRequest;
use App\Http\Requests\PromptTemplates\UpdatePromptTemplateRequest;
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
                ->orderBy(PromptTemplate::FIELD_STATUS)
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
     * @param StorePromptTemplatesRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createTemplate(StorePromptTemplateRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'template' => $this->templateRepository->createPromptTemplate($data)
        ]);
    }

    /**
     * @param PromptTemplate $template 
     * @param UpdatePromptTemplateRequest $request 
     * @return JsonResponse 
     */
    public function updateTemplate(PromptTemplate $template, UpdatePromptTemplateRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            '$template' => $template->{PromptTemplate::FIELD_ID},
            'status' => $this->templateRepository->updatePromptTemplate($template, $data)
        ]);
    }

    /**
     * @param PromptTemplate $template
     * @param DestroyPromptTemplateRequest $request 
     * @return JsonResponse 
     */
    public function deleteTemplate(PromptTemplate $template, DestroyPromptTemplateRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $template->delete()
        ]);
    }
}
