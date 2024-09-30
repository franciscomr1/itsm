<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->resource->id,
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'business_name' => $this->when(!is_null($this->resource->business_name), $this->resource->business_name),
            'address' => $this->when(!is_null($this->resource->address), $this->resource->address),
            'city' => $this->when(!is_null($this->resource->city), $this->resource->city),
            'state' => $this->when(!is_null($this->resource->state), $this->resource->state),
            'postal_code' => $this->when(!is_null($this->resource->postal_code), $this->resource->postal_code),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d'),
        ];
    }
}
