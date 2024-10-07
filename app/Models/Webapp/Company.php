<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;

use DateTimeInterface;

class Company extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'name',
        'business_name',
        'address',
        'city',
        'state',
        'postal_code'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
