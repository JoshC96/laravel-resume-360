<?php

namespace App\Http\Resources\User;


use App\Models\User;
use App\Models\UserReferee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRefereeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            UserReferee::FIELD_NAME => $this->{UserReferee::FIELD_NAME} ?? '',
            UserReferee::FIELD_POSITION => $this->{UserReferee::FIELD_POSITION},
            UserReferee::FIELD_DESCRIPTION => $this->{UserReferee::FIELD_DESCRIPTION},
            UserReferee::FIELD_PHONE => $this->{UserReferee::FIELD_PHONE},
            UserReferee::FIELD_EMAIL => $this->{UserReferee::FIELD_EMAIL},
            UserReferee::RELATION_USER => $this->{UserReferee::RELATION_USER}?->{User::FIELD_NAME},
            UserReferee::FIELD_ENTITY => $this->{UserReferee::FIELD_ENTITY},
        ];
    }
}
