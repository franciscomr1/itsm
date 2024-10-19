<?php

namespace App\Http\Resources\Webapp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'provider' => $this->when(!is_null($this->resource->provider->name), $this->resource->provider->name),
            'provider_id' => $this->when(!is_null($this->resource->provider_id), $this->resource->provider_id),
            'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
            'invoice_number' => $this->when(!is_null($this->resource->invoice_number), $this->resource->invoice_number),
            'invoice_date' => $this->when(!is_null($this->resource->invoice_date), $this->resource->invoice_date),
            'warranty_start_date' => $this->when(!is_null($this->resource->warranty_start_date), $this->resource->warranty_start_date),
            'warranty_expiration_date' => $this->when(!is_null($this->resource->warranty_expiration_date), $this->resource->warranty_expiration_date),
            'contract_attached_path' =>  $this->resource->contract_attached_path,
            'purchase_order' => $this->when(!is_null($this->resource->purchase_order), $this->resource->purchase_order),
            'purchase_date' => $this->when(!is_null($this->resource->purchase_date), $this->resource->purchase_date),
            'created_by' => $this->when(!is_null($this->resource->created_by), $this->resource->created_by),
            'updated_by' => $this->when(!is_null($this->resource->updated_by), $this->resource->updated_by),
            'created_at' => $this->when(!is_null($this->resource->created_at), $this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => $this->when(!is_null($this->resource->updated_at), $this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
