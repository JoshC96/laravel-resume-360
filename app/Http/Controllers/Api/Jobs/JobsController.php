<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Jobs\JobApplicationResource;
use App\Http\Resources\Jobs\JobListingResource;
use App\Jobs\QuickApplicationJob;
use App\Models\JobListing;
use App\Models\UserJobApplication;
use App\Repositories\JobListingRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OpenAiPromptService;

class JobsController extends ApiController
{

    public function __construct(
        Request $request, 
        protected JobListingRepository $jobListingRepository,
        protected OpenAiPromptService $openAiPromptService
    )
    {
        parent::__construct($request);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     */
    public function getJobs(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                'jobs_paginated' => JobListing::query()
                    ->paginate(
                        $data['per_page'] ?? 20,
                        ['*'],
                        'page',
                        $data['page'] ?? 1
                    )
                    ->onEachSide(1)
                    ->through(fn ($jobListing) => new JobListingResource($jobListing))
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve jobs, error code:' . $exception->getCode()
            ]);
        }
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     */
    public function getRecommendedJobs(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                'jobs' => JobListingResource::collection(JobListing::inRandomOrder()->limit(5)->get())
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve jobs, error code:' . $exception->getCode()
            ]);
        }
    }


    /**
     * @param Request $request 
     * @return JsonResponse 
     */
    public function getApplications(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            return $this->formatResponse([
                'applications' => JobApplicationResource::collection(UserJobApplication::query()->paginate(10))
            ]);
        } catch (Exception $exception) {
            return $this->formatResponse([
                'status' => false,
                'message' => 'Failed to retrieve applications, error code:' . $exception->getMessage()
            ]);
        }
    }


    /**
     * @param Request $request 
     * @return JsonResponse 
     */
    public function quickApply(JobListing $jobListing, Request $request): JsonResponse
    {
        $data = $request->collect();

        QuickApplicationJob::dispatch(Auth::user(), $jobListing);

        return $this->formatResponse([
            'status' => true
        ]);
    }

    /**
     * @param Request $request 
     * @return JsonResponse 
     */
    public function generateCoverLetter(JobListing $jobListing, Request $request): JsonResponse
    {
        $data = $request->collect();

        $coverLetterPrompt = $this->openAiPromptService->generateCoverLetterPrompt(Auth::user(), $jobListing);

        [
            'prompt' => $coverLetterPrompt,
            'response' => $coverLetterResponse
        ] = $this->openAiPromptService->sendPrompt($coverLetterPrompt);

        return $this->formatResponse([
            'status' => true,
            'coverLetter' => $coverLetterResponse
        ]);
    }
}