<?php

namespace App\Http\Resources\Prompts;

use App\Enums\PromptTemplateLocation;
use App\Enums\PromptTemplateStatus;
use App\Models\PromptTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromptTemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{PromptTemplate::FIELD_ID},
            'content' => $this->{PromptTemplate::FIELD_CONTENT},
            'status' => $this->{PromptTemplate::FIELD_STATUS},
            'use_location' => $this->{PromptTemplate::FIELD_USE_LOCATION},
            'statusName' => PromptTemplateStatus::getDisplayString($this->{PromptTemplate::FIELD_STATUS}),
            'locationName' => PromptTemplateLocation::getDisplayString($this->{PromptTemplate::FIELD_USE_LOCATION}),
            'createdBy' => $this->{PromptTemplate::RELATION_CREATED_BY}?->{User::FIELD_NAME},
            'createdAt' => $this->{PromptTemplate::CREATED_AT},
            'updatedBy' => $this->{PromptTemplate::RELATION_UPDATED_BY}?->{User::FIELD_NAME},
            'updatedAt' => $this->{PromptTemplate::UPDATED_AT},
        ];
    }
}
