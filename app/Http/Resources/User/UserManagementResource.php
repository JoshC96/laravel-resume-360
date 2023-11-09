<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserManagementResource extends JsonResource
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
            User::FIELD_VERIFIED_AT => $user->{User::FIELD_VERIFIED_AT},
            User::FIELD_BIO => $user->{User::FIELD_BIO},
            User::FIELD_DATE_OF_BIRTH => $user->{User::FIELD_DATE_OF_BIRTH},
            User::FIELD_WORK_PHONE => $user->{User::FIELD_WORK_PHONE},
            User::FIELD_WEBSITE => $user->{User::FIELD_WEBSITE},
            User::FIELD_ADDRESS => $user->{User::FIELD_ADDRESS},
            User::FIELD_CURRENT_ROLE => $user->{User::FIELD_CURRENT_ROLE},
            'created_at' => $user->created_at,
            'roles' => array_column($user->roles->toArray(), 'name'),
            'permissions' => array_column($user->permissions->toArray(), 'name')
        ];
    }
}
