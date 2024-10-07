<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Employee extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'branch_id',
        'position_id',
        'first_name',
        'last_name',
        'employee_id_number',
        'hire_date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
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
            'position_id'=>[
                'related'=> [
                    'data'=> 'position', 'title'=> __('models.position')
                ],
                'data'=> Position::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
