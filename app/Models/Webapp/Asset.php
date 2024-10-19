<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Asset extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'contract_id',
        'branch_id',
        'asset_model_id',
        'asset_status_id',
        'asset_condition_id',
        'employee_id',
        'asset_tag',
        'serial_number',
        'service_tag',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function asset_model(): BelongsTo
    {
        return $this->belongsTo(AssetModel::class);
    }

    public function asset_status(): BelongsTo
    {
        return $this->belongsTo(AssetStatus::class);
    }

    public function asset_condition(): BelongsTo
    {
        return $this->belongsTo(AssetCondition::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getRelationships(): array
    {
        return [
            'branch_id'=>[
                'related'=> [
                    'data'=> 'branch', 'title'=> __('models.branch')
                ],
                'data'=> Branch::select('id', 'name')->pluck('name', 'id')
            ],
            'contract_id'=>[
                'related'=> [
                    'data'=> 'contract', 'title'=> __('models.contract')
                ],
                'data'=> Contract::select('id', 'name')->pluck('name', 'id')
            ],
            'asset_model_id'=>[
                'related'=> [
                    'data'=> 'asset_model', 'title'=> __('models.asset_model')
                ],
                'data'=> AssetModel::select('id', 'name')->pluck('name', 'id')
            ],
            'asset_status_id'=>[
                'related'=> [
                    'data'=> 'asset_status', 'title'=> __('models.asset_status')
                ],
                'data'=> AssetStatus::select('id', 'name')->pluck('name', 'id')
            ],
            'asset_condition_id'=>[
                'related'=> [
                    'data'=> 'asset_condition', 'title'=> __('models.asset_condition')
                ],
                'data'=> AssetCondition::select('id', 'name')->pluck('name', 'id')
            ],
            'employee_id'=>[
                'related'=> [
                    'data'=> 'employee', 'title'=> __('models.employee')
                ],
                'data'=> Employee::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
