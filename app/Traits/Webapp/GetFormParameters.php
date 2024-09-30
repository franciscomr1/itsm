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
        $columnPropierties = [];
        $formColumns = [];

        if (empty($attributes)) {
            foreach ($modelFillable as $key => $value) {
                $formColumns[$value] = null;
            }
        } else {
            $formColumns = $attributes;
        }

        if (method_exists($this, 'getRelationshipColumns')) {
            $modelRelationships = self::getRelationshipColumns();
            foreach ($modelRelationships as $key => $value) {
                $modelFillable = array_diff($modelFillable, array($key));
                $columnPropierties[$key] = [
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
                    $columnPropierties[$key] = [
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
                    $columnPropierties[$key] = [
                        'id' => $value['name'],
                        'label' =>  $value['name'],
                        'type' => 'checkbox',
                    ];
                }
            }
        }

        return [
            'title' => self::getTable(),
            'resource' => self::getTable(),
            'formFields' => $formColumns,
            'fieldPropierties' => $columnPropierties

        ];
    }
}
