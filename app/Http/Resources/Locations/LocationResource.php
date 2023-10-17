<?php

namespace App\Http\Resources\Locations;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->{Location::FIELD_NAME},
            'address' => $this->{Location::FIELD_ADDRESS},
            'city' => $this->{Location::FIELD_CITY},
            'state' => $this->{Location::FIELD_STATE},
            'country' => $this->{Location::FIELD_COUNTRY},
            'postal_code' => $this->{Location::FIELD_POSTAL_CODE},
            'latitude' => $this->{Location::FIELD_LATITUDE},
            'longitude' => $this->{Location::FIELD_LONGITUDE}
        ];
    }
}
