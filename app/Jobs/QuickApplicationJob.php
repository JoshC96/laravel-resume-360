<?php

namespace App\Jobs;

use App\Models\JobListing;
use App\Models\User;
use App\Models\UserJobApplication;
use App\Models\UserResume;
use App\Repositories\JobApplicationRepository;
use App\Repositories\ResumeRepository;
use App\Services\OpenAiPromptService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QuickApplicationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $timeout = 120;

    /** @var User|null */
    protected $user = null;

    /** @var JobListing|null */
    protected $jobListing = null;

    /**
     * Create a new job instance.
     */
    public function __construct(
        User $user, 
        JobListing $jobListing
    ) {
        $this->onQueue('applications');

        $this->user = $user;
        $this->jobListing = $jobListing;
    }

    /**
     * 
     * Execute the job.
     */
    public function handle(
        OpenAiPromptService $openAiPromptService, 
        JobApplicationRepository $jobApplicationRepository,
        ResumeRepository $resumeRepository
    ): void {
        $coverLetterPrompt = $openAiPromptService->generateCoverLetterPrompt($this->user, $this->jobListing);
        $resumePrompt = $openAiPromptService->generateResumePrompt($this->user, $this->jobListing);

        [
            'prompt' => $coverLetterPrompt, 
            'response' => $coverLetterResponse
        ] = $openAiPromptService->sendPrompt($coverLetterPrompt);

        [
            'prompt' => $resumePrompt,
            'response' => $resumeResponse
        ] = $openAiPromptService->sendPrompt($resumePrompt);

        $resume = $resumeRepository->createUserResume([
            UserResume::FIELD_IS_PUBLIC => true,
            UserResume::FIELD_CONTENT => $resumeResponse,
            UserResume::FIELD_USER_ID => $this->user->{User::FIELD_ID},
        ]);

        $jobApplicationRepository->createUserJobApplication([
            UserJobApplication::FIELD_STATUS => 1,
            UserJobApplication::FIELD_APPLIED_WITH_PROFILE => true,
            UserJobApplication::FIELD_APPLIED_AT => Carbon::now(),
            UserJobApplication::FIELD_USER_ID => $this->user->{User::FIELD_ID},
            UserJobApplication::FIELD_JOB_LISTING_ID => $this->jobListing->{JobListing::FIELD_ID},
            UserJobApplication::FIELD_COVER_LETTER => $coverLetterResponse,
            UserJobApplication::FIELD_RESUME_ID => $resume->{UserResume::FIELD_ID},
        ]);
    }
}
