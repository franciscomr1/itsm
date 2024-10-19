<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetModelResource extends JsonResource
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
            'asset_category' => $this->when(!is_null($this->resource->asset_type->asset_category->name), $this->resource->asset_type->asset_category->name),
            'manufacturer' => $this->when(!is_null($this->resource->manufacturer->name), $this->resource->manufacturer->name),
            'manufacturer_id' => $this->when(!is_null($this->resource->manufacturer_id), $this->resource->manufacturer_id),
            'asset_type' => $this->when(!is_null($this->resource->asset_type->name), $this->resource->asset_type->name),
            'asset_type_id' => $this->when(!is_null($this->resource->asset_type_id), $this->resource->asset_type_id),
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
