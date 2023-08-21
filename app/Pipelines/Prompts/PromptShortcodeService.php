<?php

namespace App\Pipelines\Prompts\Shortcodes;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;
use App\Abstracts\PromptShortcode;
use App\Pipelines\Prompts\PromptPayload;

class PromptShortcodeService {

    public const SHORTCODES = [
        UserNameShortcode::class
    ];

    /**
     * @return array 
     */
    public function getShortcodes(): array
    {
        return collect(self::SHORTCODES)->map(function(string $shortcode) {
            /** @var PromptShortcode $class */
            $class = App::make($shortcode);

            return ['label' => $class->getLabel(), 'value' => $class->getKey()];
        })->toArray();
    }

    /**
     * @param string $message 
     * @param PromptPayload|null $payload 
     * @return string 
     */
    public function handle(string $message, ?PromptPayload $payload = null): string
    {
        $pipeline = App::make(Pipeline::class);

        $pipeline->send(compact('message', 'payload'))
            ->through(self::SHORTCODES)
            ->via('handle')
            ->then(function($result) use (&$message) { $message = $result['message']; })
    }
}
