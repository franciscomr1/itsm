<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestTypeResource extends JsonResource
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
            'issue_type_id' => $this->when(!is_null($this->resource->issue_type_id), $this->resource->issue_type_id),
            'issue_type' => $this->when(!is_null($this->resource->issue_type->name), $this->resource->issue_type->name),
            'request_category_id' => $this->when(!is_null($this->resource->request_category_id), $this->resource->request_category_id),
            'request_category' => $this->when(!is_null($this->resource->request_category->name), $this->resource->request_category->name),
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
