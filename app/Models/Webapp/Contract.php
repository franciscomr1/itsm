<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Contract extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'provider_id',
        'name',
        'invoice_number',
        'invoice_date',
        'warranty_start_date',
        'warranty_expiration_date',
        'contract_attached_path',
        'purchase_order',
        'purchase_date'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getDatatableColumns(){
        return  [
            'resource'=> 'contracts',
            'title'=> 'Contratos',
            'columns' => [
                ["data"=>"id","title"=>"ID"],
                ["data"=>"provider_id","title"=>"Proveedor ID", "visible"=> true],
                ["data"=>"provider","title"=>"Proveedor"],
                ["data"=>"name","title"=>"Nombre","type"=>"string"],
                ["data"=>"invoice_number","title"=>"Folio Factura","type"=>"string"],
                ["data"=>"invoice_date","title"=>"Fecha Factura"],
                ["data"=>"warranty_start_date","title"=>"Inicio de la garantia"],
                ["data"=>"warranty_expiration_date","title"=>"Expiración de la garantia"],
                ["data"=>"contract_attached_path","title"=>"Adjuntar archivo","type"=>"string"],
                ["data"=>"purchase_order","title"=>"Orden de Compra","type"=>"string"],
                ["data"=>"purchase_date","title"=>"Fecha de Compra"],
                ["data"=>"created_by","title"=>"Creado Por","type"=>"string"],
                ["data"=>"updated_by","title"=>"Actualizado Por","type"=>"string"],
                ["data"=>"created_at","title"=>"Creado a las","type"=>"date"],
                ["data"=>"updated_at","title"=>"Actualizado a las","type"=>"date"],
                ["data"=>null,"defaultContent"=>"","name"=>"update"]
            ]
        ];
    }

    public function getRelationships(): array
    {
        return [
            'provider_id'=>[
                'related'=> [
                    'data'=> 'provider', 'title'=> __('models.provider')
                ],
                'data'=> Provider::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
