<?php

namespace App\Http\Resources\Entities;

use App\Http\Resources\Contacts\ContactResource;
use App\Enums\EntityType;
use App\Http\Resources\Locations\EntityLocationResource;
use App\Models\Entity;
use App\Models\EntityLocation;
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
            Entity::FIELD_ID => $this->{Entity::FIELD_ID},
            Entity::FIELD_NAME => $this->{Entity::FIELD_NAME},
            Entity::FIELD_PHONE => $this->{Entity::FIELD_PHONE},
            Entity::FIELD_WEBSITE => $this->{Entity::FIELD_WEBSITE},
            Entity::FIELD_DESCRIPTION => $this->{Entity::FIELD_DESCRIPTION},
            Entity::FIELD_TYPE => EntityType::getDisplayString($this->{Entity::FIELD_TYPE}),
            Entity::FIELD_INDUSTRY => $this->{Entity::FIELD_INDUSTRY},
            'employees' => $this->{Entity::FIELD_EMPLOYEE_SIZE},
            'createdAt' => Carbon::parse($this->{Entity::CREATED_AT})->format('d M y'),
            Entity::RELATION_CONTACTS => ContactResource::collection($this->{Entity::RELATION_CONTACTS}),
            Entity::RELATION_APPLICATIONS => $this->{Entity::RELATION_APPLICATIONS},
            Entity::RELATION_JOBS => $this->{Entity::RELATION_JOBS},
            Entity::RELATION_LOCATIONS => EntityLocationResource::collection($this->{Entity::RELATION_LOCATIONS}),
        ];
    }
}
