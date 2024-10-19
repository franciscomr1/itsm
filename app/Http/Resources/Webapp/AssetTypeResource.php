<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetTypeResource extends JsonResource
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
            'asset_category' => $this->when(!is_null($this->resource->asset_category->name), $this->resource->asset_category->name),
            'asset_category_id' => $this->when(!is_null($this->resource->asset_category_id), $this->resource->asset_category_id),
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'is_assignable' => $this->when(!is_null($this->resource->is_assignable), $this->resource->is_assignable),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
