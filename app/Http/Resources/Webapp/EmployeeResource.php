<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'branch_id' => $this->when(!is_null($this->resource->branch_id), $this->resource->branch_id),
            'branch' => $this->when(!is_null($this->resource->branch->name), $this->resource->branch->name),
            'position_id' => $this->when(!is_null($this->resource->position_id), $this->resource->position_id),
            'position' => $this->when(!is_null($this->resource->position->name), $this->resource->position->name),
            'first_name' => $this->when(!is_null($this->resource->first_name), $this->resource->first_name),
            'last_name' => $this->when(!is_null($this->resource->last_name), $this->resource->last_name),
            'employee_id_number' => $this->when(!is_null($this->resource->employee_id_number), $this->resource->employee_id_number),
            'hire_date' => $this->when(!is_null($this->resource->hire_date), $this->resource->hire_date),
            'is_active' => $this->when(!is_null($this->resource->is_active), $this->resource->is_active),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
