<?php

namespace App\Http\Resources\Contacts;

use App\Models\EntityContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->{EntityContact::FIELD_NAME},
            'position' => $this->{EntityContact::FIELD_POSITION},
            'description' => $this->{EntityContact::FIELD_DESCRIPTION},
            'phone' => $this->{EntityContact::FIELD_PHONE},
            'email' => $this->{EntityContact::FIELD_EMAIL},
            'userId' => $this->{EntityContact::FIELD_USER_ID},
            'entityId' => $this->{EntityContact::FIELD_ENTITY_ID},
            'createdAt' => Carbon::parse($this->{EntityContact::CREATED_AT})->format('d M y'),
        ];
    }
}
