<?php

namespace App\Http\Resources\User;

use App\Http\Requests\User\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            User::FIELD_ID => $user->{User::FIELD_ID},
            User::FIELD_UUID => $user->{User::FIELD_UUID},
            User::FIELD_NAME => $user->{User::FIELD_NAME},
            User::FIELD_BIO => $user->{User::FIELD_BIO},
            User::FIELD_EMAIL => $user->{User::FIELD_EMAIL},
            User::FIELD_MOBILE => $user->{User::FIELD_MOBILE},
            User::FIELD_LOCATION => $user->{User::FIELD_LOCATION},
            'created_at' => $user->created_at,
            'roles' => $user->roles,
            'permissions' =>  $user->permissions
        ];
    }
}
