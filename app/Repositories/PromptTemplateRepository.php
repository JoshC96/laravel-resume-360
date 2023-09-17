<?php

namespace App\Repositories;

use App\Models\PromptTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\MassAssignmentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Facades\Auth;

class PromptTemplateRepository
{

    /**
     * @param array $data 
     * @return PromptTemplate
     */
    public function createPromptTemplate(array $data): PromptTemplate
    {
        $promptTemplate = new PromptTemplate();
        $promptTemplate->{PromptTemplate::FIELD_CREATED_BY_ID} = Auth::user()->{User::FIELD_ID};
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
        $promptTemplate->{PromptTemplate::FIELD_UPDATED_BY_ID} = Auth::user()->{User::FIELD_ID};

        return $promptTemplate->save();
    }
}