<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'subject' => (string) $this->resource->subject,
            'description' => (string) $this->resource->description,
            'issue_type_id' => $this->when(!is_null($this->resource->issue_type_id), $this->resource->issue_type_id),
            'issue_type' => $this->when(!is_null($this->resource->issue_type->name), $this->resource->issue_type->name),
            'request_type_id' => $this->when(!is_null($this->resource->request_type_id), $this->resource->request_type_id),
            'request_type' => $this->when(!is_null($this->resource->request_type->name), $this->resource->request_type->name),
            'request_status_id' => $this->when(!is_null($this->resource->request_status_id), $this->resource->request_status_id),
            'request_status' => $this->when(!is_null($this->resource->request_status->name), $this->resource->request_status->name),
            'urgency_level_id' => $this->when(!is_null($this->resource->urgency_level_id), $this->resource->urgency_level_id),
            'urgency_level' => $this->when(!is_null($this->resource->urgency_level->name), $this->resource->urgency_level->name),
            'priority_level_id' => $this->when(!is_null($this->resource->priority_level_id), $this->resource->priority_level_id),
            'priority_level' => $this->when(!is_null($this->resource->priority_level->name), $this->resource->priority_level->name),
            'request_channel_id' => $this->when(!is_null($this->resource->request_channel_id), $this->resource->request_channel_id),
            'request_channel' => $this->when(!is_null($this->resource->request_channel->name), $this->resource->request_channel->name),
            'employee_id' => $this->when(!is_null($this->resource->employee_id), $this->resource->employee_id),
            'employee' => $this->when(!is_null($this->resource->employee->getFullNameAttribute()), $this->resource->employee->getFullNameAttribute()),
            'assigned_to' => $this->resource->assigned_to,
            'assigned_at' => $this->resource->assigned_at,
            'escalated_at' =>  $this->resource->escalated_at,
            'closed_at' => $this->resource->closed_at,
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d'),
        ];
    }
}
