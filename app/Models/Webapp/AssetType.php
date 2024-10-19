<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class AssetType extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'asset_category_id',
        'name',
        'is_assignable',
    ];

    public function asset_category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getRelationships(): array
    {
        return [
            'asset_category_id'=>[
                'related'=> [
                    'data'=> 'asset_category', 'title'=> __('models.asset_category')
                ],
                'data'=> AssetCategory::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
