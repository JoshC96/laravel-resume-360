<?php

namespace App\Repositories;

use App\Models\Prompt;

class AiPromptRepository
{

    /**
     * @param array $data 
     * @return Prompt
     */
    public function createPrompt(array $data): Prompt
    {
        $prompt = new Prompt();
        $prompt->fill($data);
        $prompt->save();

        return $prompt;
    }
}