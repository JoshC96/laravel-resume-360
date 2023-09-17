<?php

namespace App\Services;

use App\Enums\AiSources;
use App\Enums\PromptTemplateLocation;
use App\Models\AiResponse;
use App\Models\JobListing;
use App\Models\Prompt;
use App\Models\PromptTemplate;
use App\Models\User;
use App\Pipelines\Prompts\PromptPayloadFactory;
use App\Pipelines\Prompts\PromptShortcodeService;
use App\Repositories\AiPromptRepository;
use App\Repositories\AiResponseRepository;
use Exception;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use InvalidArgumentException as GlobalInvalidArgumentException;
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
        protected AiResponseRepository $aiResponseRepository,
        protected AiPromptRepository $aiPromptRepository
    ) {}


    /**
     * @param PromptTemplateLocation $promptTemplateLocation 
     * @param User $user 
     * @return string 
     * @throws GlobalInvalidArgumentException 
     * @throws ModelNotFoundException 
     */
    public function getPromptTemplate(PromptTemplateLocation $promptTemplateLocation, User $user = null): string
    {
        $template = PromptTemplate::query()
            ->where(PromptTemplate::FIELD_USE_LOCATION, $promptTemplateLocation->value)
            ->firstOrFail();

        // @Todo: return the template if the user is premium

        return $template->{PromptTemplate::FIELD_CONTENT};
    }

    /**
     * @param User|null $user
     * @param JobListing $jobListing 
     * @return string 
     */
    public function preparePrompt(PromptTemplateLocation $promptTemplateLocation, JobListing $jobListing, User $user = null): string
    {
        $promptTemplate = $this->getPromptTemplate($promptTemplateLocation, $user);
        $payload = PromptPayloadFactory::create([
            'job-listing' => $jobListing,
            'user' => $user,
        ]);

        return $this->promptShortcodeService->handle($promptTemplate, $payload);
    }

    /**
     * @param string $prompt 
     * @param User|null $user 
     * @return array 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws ErrorException 
     * @throws UnserializableResponse 
     * @throws TransporterException 
     * @throws Exception 
     */
    public function sendPrompt(string $prompt, User $user = null): array
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
        $source = AiSources::OPENAI->value;

        if (!$content) {
            throw new Exception('No content received from OpenAI response.');
        }

        try {
            $promptRecord = $this->aiPromptRepository->createPrompt([
                Prompt::FIELD_CONTENT => $prompt,
                Prompt::FIELD_CREATED_BY_ID => $user->{User::FIELD_ID}
            ]);

            $this->aiResponseRepository->createAiResponse([
                AiResponse::FIELD_PAYLOAD => json_encode($payload->toArray()),
                AiResponse::FIELD_CONTENT => $content,
                AiResponse::FIELD_PROMPT_ID => $promptRecord->{Prompt::FIELD_ID},
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
