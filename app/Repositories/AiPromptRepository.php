<?php

namespace App\Repositories;

use App\Models\Prompt;
use Illuminate\Database\Eloquent\MassAssignmentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;

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

    /**
     * @param Prompt $prompt 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updatePrompt(Prompt $prompt, array $data): bool
    {
        $prompt->fill($data);
        return $prompt->save();
    }
}