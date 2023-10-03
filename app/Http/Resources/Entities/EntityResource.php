<?php

namespace App\Http\Resources\Entities;

use App\Enums\EntityType;
use App\Models\Entity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{Entity::FIELD_ID},
            'name' => $this->{Entity::FIELD_NAME},
            'description' => $this->{Entity::FIELD_DESCRIPTION},
            'type' => EntityType::getDisplayString($this->{Entity::FIELD_TYPE}),
            'employees' => $this->{Entity::FIELD_EMPLOYEE_SIZE},
            'createdAt' => Carbon::parse($this->{Entity::CREATED_AT})->format('d M y')
        ];
    }
}
