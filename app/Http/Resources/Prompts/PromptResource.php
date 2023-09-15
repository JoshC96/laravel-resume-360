<?php

namespace App\Http\Resources\Prompts;

use App\Models\Prompt;
use App\Models\PromptTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{Prompt::FIELD_ID},
            'content' => $this->{Prompt::FIELD_CONTENT},
            'template' => $this->{Prompt::RELATION_TEMPLATE}?->{PromptTemplate::FIELD_CONTENT},
            'createdBy' => $this->{Prompt::RELATION_CREATED_BY}?->{User::FIELD_NAME},
            'createdAt' => $this->{Prompt::CREATED_AT},
        ];
    }
}
