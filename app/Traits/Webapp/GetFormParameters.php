<?php

namespace App\Traits\Webapp;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

trait GetFormParameters
{
    public function scopeGetFormParamaters(Builder $builder, array $attributes)
    {
        $modelAttributes =  Schema::getColumns(self::getTable());
        $modelFillable = self::getFillable();
        $formFields = [];
        $formFieldValues = [];

        if (empty($attributes)) {
            foreach ($modelFillable as $key => $value) {
                $formFieldValues[$value] = null;
            }
        } else {
            $formFieldValues = $attributes;
        }

        if (method_exists($this, 'getRelationshipColumns')) {
            $modelRelationships = self::getRelationshipColumns();
            foreach ($modelRelationships as $key => $value) {
                $modelFillable = array_diff($modelFillable, array($key));
                $formFields[$key] = [
                    'id' => $key,
                    'label' =>  $key,
                    'type' => 'select',
                    'propierties' => [
                        'data' => $value,
                        'required' => true
                    ]
                ];
            }
        }
        foreach ($modelAttributes as $key => $value) {
            if (in_array($value['name'], $modelFillable) && !$value['default']) {
                if ($value['type_name'] === 'varchar') {
                    $formFields[$key] = [
                        'id' => $value['name'],
                        'label' =>   __('models.' . $value['name']),
            //   __('models.' . $value['name]);
            
                        'type' => 'input',
                        'propierties' => [
                            'type' => 'text',
                            'required' => !$value['nullable']
                        ]
                    ];
                } elseif ($value['type_name'] === 'boolean') {
                    $formFields[$key] = [
                        'id' => $value['name'],
                        'label' =>  $value['name'],
                        'type' => 'checkbox',
                    ];
                }
            }
        }

        return [
            'title' => __('models.' . self::getTable()),
            'resource' => self::getTable(),
            'fieldValues' => $formFieldValues,
            'fields' => $formFields

        ];
    }
}
