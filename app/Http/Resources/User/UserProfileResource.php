<?php

namespace App\Http\Resources\User;

use App\Http\Requests\User\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->resource;

        return [
            UserProfileRequest::REQUEST_BIO => $user->{User::FIELD_BIO} ?? '',
            UserProfileRequest::REQUEST_REFEREES => $user->{User::RELATION_REFEREES},
            UserProfileRequest::REQUEST_QUALFICATIONS => $user->{User::RELATION_QUALIFICATIONS},
            UserProfileRequest::REQUEST_WORK_HISTORY => $user->{User::RELATION_WORK_EXPERIENCES},
            UserProfileRequest::REQUEST_CERTIFICATIONS => $user->{User::RELATION_CERTIFICATIONS},
            UserProfileRequest::REQUEST_LICENSES => $user->{User::RELATION_LICENCES},
            UserProfileRequest::REQUEST_PUBLICATIONS => $user->{User::RELATION_PUBLICATIONS},
        ];
    }
}
