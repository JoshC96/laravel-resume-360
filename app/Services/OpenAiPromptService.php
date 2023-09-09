<?php

namespace App\Services;

use App\Models\AiResponse;
use App\Models\JobListing;
use App\Models\Prompt;
use App\Models\User;
use App\Pipelines\Prompts\PromptPayloadFactory;
use App\Pipelines\Prompts\PromptShortcodeService;
use App\Repositories\AiResponseRepository;
use Exception;
use Illuminate\Support\Arr;
use OpenAI\Exceptions\InvalidArgumentException;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class OpenAiPromptService
{

    public function __construct(
        protected PromptShortcodeService $promptShortcodeService,
        protected AiResponseRepository $aiResponseRepository
    ) {}

    /**
     * @param User $user 
     * @param JobListing $jobListing 
     * @return string 
     */
    public function generateCoverLetterPrompt(User $user, JobListing $jobListing): string
    {
        $promptTemplate = Prompt::STANDARD_MAKE_COVER_LETTER;
        $payload = PromptPayloadFactory::create([
            'job-listing' => $jobListing,
            'user' => $user,
        ]);

        return $this->promptShortcodeService->handle($promptTemplate, $payload);
    }

    /**
     * @param User $user 
     * @param JobListing $jobListing 
     * @return string 
     */
    public function generateResumePrompt(User $user, JobListing $jobListing): string
    {
        $promptTemplate = Prompt::STANDARD_MAKE_RESUME;
        $payload = PromptPayloadFactory::create([
            'job-listing' => $jobListing,
            'user' => $user,
        ]);

        return $this->promptShortcodeService->handle($promptTemplate, $payload);
    }

    /**
     * @param string $prompt 
     * @return array 
     * @throws InvalidArgumentException 
     * @throws ErrorException 
     * @throws UnserializableResponse 
     * @throws TransporterException 
     */
    public function sendPrompt(string $prompt): array
    {
        $payload = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user', 
                    'content' => $prompt
                ],
            ],
        ]);

        $content = Arr::get($payload, 'choices.0.message.content');
        $remoteId = Arr::get($payload, 'id');
        $model = Arr::get($payload, 'model');
        $source = 1; // @todo update to an the Ai Enum

        if (!$content) {
            throw new Exception('No content received from OpenAI response.');
        }

        try {
            $this->aiResponseRepository->createAiResponse([
                AiResponse::FIELD_PAYLOAD => json_encode($payload->toArray()),
                AiResponse::FIELD_CONTENT => $content,
                AiResponse::FIELD_PROMPT => $prompt,
                AiResponse::FIELD_SOURCE => $source,
                AiResponse::FIELD_REMOTE_ID => $remoteId,
                AiResponse::FIELD_MODEL => $model,
            ]);
        } catch (Throwable $exception) {
            // @Todo log an error to sentry
        }

        return [
            'prompt' => $prompt,
            'response' => $content
        ];
    }

}
