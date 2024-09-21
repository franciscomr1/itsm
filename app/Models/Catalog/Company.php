<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Company extends Model
{
    use HasFactory;

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
