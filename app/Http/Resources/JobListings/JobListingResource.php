<?php

namespace App\Http\Resources\JobListings;

use App\Http\Requests\User\UserProfileRequest;
use App\Models\Entity;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->{JobListing::FIELD_TITLE},
            'role' => $this->{JobListing::FIELD_ROLE},
            'description' => $this->{JobListing::FIELD_DESCRIPTION},
            'salary_min' => $this->{JobListing::FIELD_SALARY_MIN},
            'salary_max' => $this->{JobListing::FIELD_SALARY_MAX},
            'industry' => $this->{JobListing::FIELD_INDUSTRY},
            'entity' => $this->{JobListing::RELATION_ENTITY}->{Entity::FIELD_NAME}
        ];
    }
}
