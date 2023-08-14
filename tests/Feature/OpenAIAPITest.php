<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;
use Tests\TestCase;

class OpenAIAPITest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_openai_library_fake_equals_response(): void
    {
        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [
                    [
                        'text' => 'awesome.'
                    ]
                ]
            ])
        ]);

        $completion = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'Laravel is'
        ]);

        $this->assertEquals('awesome.', Arr::get($completion, 'choices.0.text'));
    }

    public function test_openai_library_fake__not_equals_response(): void
    {
        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [
                    [
                        'text' => 'wasteful.'
                    ]
                ]
            ])
        ]);

        $completion = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'Laravel is'
        ]);

        $this->assertNotEquals('awesome.', Arr::get($completion, 'choices.0.text'));
    }


    public function test_openai_library_api_response(): void
    {
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'PHP is',
        ]);

        $this->assertArrayHasKey('created', $result);
    }
}
