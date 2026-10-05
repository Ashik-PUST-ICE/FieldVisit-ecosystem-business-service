<?php

namespace App\Http\Resources\Business\Outlet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OutletResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'qr_token' => $this->qr_token,
            'address' => $this->address,
            // Administrative hierarchy: division -> ... -> village.
            'division' => $this->division,
            'district' => $this->district,
            'upazila' => $this->upazila,
            'union' => $this->union,
            'ward' => $this->ward,
            'village' => $this->village,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'geofence_radius' => $this->geofence_radius,
            'phone' => $this->phone,
            'owner_name' => $this->owner_name,
            'category' => $this->category,
            'status' => $this->status,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
