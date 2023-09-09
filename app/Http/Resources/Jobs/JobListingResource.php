<?php

namespace App\Http\Resources\Jobs;

use App\Models\Entity;
use App\Models\JobListing;
use App\Models\User;
use Carbon\Carbon;
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
            'id' => $this->{JobListing::FIELD_ID},
            'title' => $this->{JobListing::FIELD_TITLE},
            'role' => $this->{JobListing::FIELD_ROLE},
            'description' => $this->{JobListing::FIELD_DESCRIPTION},
            'salaryMin' => $this->{JobListing::FIELD_SALARY_MIN},
            'salaryMax' => $this->{JobListing::FIELD_SALARY_MAX},
            'industry' => $this->{JobListing::FIELD_INDUSTRY},
            'entity' => $this->{JobListing::RELATION_ENTITY}?->{Entity::FIELD_NAME},
            'createdAt' => Carbon::parse($this->{JobListing::CREATED_AT})->format('d M y')
        ];
    }
}
