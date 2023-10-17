<?php

namespace App\Http\Resources\Locations;

use App\Models\EntityLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->{EntityLocation::FIELD_NAME},
            'location' => new LocationResource($this->{EntityLocation::RELATION_LOCATION})
        ];
    }
}
