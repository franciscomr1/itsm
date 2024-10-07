<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetFormParameters;
use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Position extends Model
{
    use HasFactory, GetFormParameters,GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'department_id',
        'name'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getRelationships(): array
    {
        return [
            'department_id'=>[
                'related'=> [
                    'data'=> 'department', 'title'=> __('models.department')
                ],
                'data'=> Department::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }
}
