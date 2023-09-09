<?php

namespace App\Http\Resources\Jobs;

use App\Enums\JobApplicationStatus;
use App\Models\Entity;
use App\Models\JobListing;
use App\Models\UserJobApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => JobApplicationStatus::getDisplayString($this->{UserJobApplication::FIELD_STATUS}),
            'appliedAt' => Carbon::parse($this->{UserJobApplication::FIELD_APPLIED_AT})->format('d M y'),
            'viewedAt' => Carbon::parse($this->{UserJobApplication::FIELD_VIEWED_AT})->format('d M y h:ia'),
            'role' => $this->{UserJobApplication::RELATION_JOB_LISTING}?->{JobListing::FIELD_ROLE},
            'entity' => $this->{UserJobApplication::RELATION_JOB_LISTING}?->{JobListing::RELATION_ENTITY}?->{Entity::FIELD_NAME},
            'coverLetter' => $this->{UserJobApplication::FIELD_COVER_LETTER}
        ];
    }
}
