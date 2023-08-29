<?php

namespace App\Http\Controllers\Api\JobListings;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\User\UserProfileRequest;
use App\Http\Resources\JobListings\JobListingCollection;
use App\Http\Resources\JobListings\JobListingResource;
use App\Http\Resources\User\UserProfileResource;
use App\Jobs\QuickApplicationJob;
use App\Models\JobListing;
use App\Repositories\JobListingRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Prompt;
use App\Pipelines\Prompts\PromptPayloadFactory;
use App\Pipelines\Prompts\PromptShortcodeService;
use App\Services\OpenAiPromptService;

class JobListingController extends ApiController
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
                'jobs' => JobListing::query()->paginate()
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
                'jobs' => JobListing::inRandomOrder()->limit(5)->get()
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
    public function quickApply(JobListing $jobListing, Request $request): JsonResponse
    {
        $data = $request->collect();

        QuickApplicationJob::dispatch(Auth::user(), $jobListing);

        return $this->formatResponse([
            'status' => true
        ]);
    }
}