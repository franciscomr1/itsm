<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class AssetModel extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'manufacturer_id',
        'asset_type_id',
        'name',
    ];

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function asset_type(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getDatatableColumns(){
        return  [
            'resource'=> 'asset_models',
            'title'=> 'Modelos',
            'columns' => [
                ["data"=>"id","title"=>"ID"],
                ['data'=> 'asset_category', 'title'=> __('models.asset_category')],
                ['data' => 'manufacturer_id', 'title' => 'manufacturer_id','visible'=> false],
                ['data'=> 'manufacturer', 'title'=> __('models.manufacturer')],
                ["data"=>"asset_type_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'asset_type', 'title'=> __('models.asset_type')],
                ["data"=>"created_by","title"=>"Creado Por","type"=>"string"],
                ["data"=>"updated_by","title"=>"Actualizado Por","type"=>"string"],
                ["data"=>"created_at","title"=>"Creado a las","type"=>"date"],
                ["data"=>"updated_at","title"=>"Actualizado a las","type"=>"date"],
                ["data"=>null,"defaultContent"=>"","name"=>"update"],
            ]
        ];
    }

    public function getRelationships(): array
    {
        return [
            'manufacturer_id'=>[
                'related'=> [
                    'data'=> 'manufacturer', 'title'=> __('models.manufacturer')
                ],
                'data'=> Manufacturer::select('id', 'name')->pluck('name', 'id')
            ],
            'asset_type_id'=>[
                'related'=> [
                    'data'=> 'asset_type', 'title'=> __('models.asset_type')
                ],
                'data'=> AssetType::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
