<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Webapp\GetFormParameters;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;

use DateTimeInterface;

class Department extends Model
{
    use HasFactory, GetFormParameters, AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'name',
        'cost_center',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
