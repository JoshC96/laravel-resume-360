<?php

namespace App\Repositories;

use App\Models\PromptTemplate;
use Illuminate\Database\Eloquent\MassAssignmentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class PromptTemplateRepository
{

    /**
     * @param array $data 
     * @return PromptTemplate
     */
    public function createPromptTemplate(array $data): PromptTemplate
    {
        $promptTemplate = new PromptTemplate();
        $promptTemplate->fill($data);
        $promptTemplate->save();

        return $promptTemplate;
    }

    /**
     * @param PromptTemplate $promptTemplate 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updatePromptTemplate(PromptTemplate $promptTemplate, array $data): bool
    {
        $promptTemplate->fill($data);
        return $promptTemplate->save();
    }
}