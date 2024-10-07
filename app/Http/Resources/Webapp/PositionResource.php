<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'department_id' => $this->when(!is_null($this->resource->department_id), $this->resource->department_id),
            'department' => $this->when(!is_null($this->resource->department->name), $this->resource->department->name),
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
