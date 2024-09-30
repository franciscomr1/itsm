<?php

namespace App\Traits\Database;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

trait AddFieldsCreatedByAndUpdatedBy
{
    public static function bootAddFieldsCreatedByAndUpdatedBy()
    {
        static::creating(function ($model) {
            $userName = Fortify::username();
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::user()->$userName;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->$userName;
            }
        });

        static::updating(function ($model) {
            $userName = Fortify::username();
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->$userName;
            }
        });
    }
}
