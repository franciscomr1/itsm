<?php

namespace App\Traits\Webapp;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait GetResourceFormFields
{
    public function scopeGetResourceFormFields(Builder $builder) {
        $tableAttributes =  Schema::getColumns(self::getTable());
        $modelFillable = self::getFillable();
        $formFields = [];
        $formFieldValues = [];

        foreach ($modelFillable as $key => $value) {
            $formFieldValues[$value] = null;
        }

        if (method_exists($this, 'getRelationships')) {
            $relationships = self::getRelationships();
            foreach ($relationships as $key => $value) {
                $modelFillable = array_diff($modelFillable, array($key));
                array_push($formFields, [
                    'id' => $key,
                    'label' =>  __('models.' . $key),
                    'type' => 'select',
                    'propierties' => [
                        'data' => $value['data'],
                        'required' => true
                    ]
                ]);
            }
        }

        foreach ($tableAttributes as $key => $value) {
            if (in_array($value['name'], $modelFillable) && !$value['default']) {
                if ($value['type_name'] === 'varchar') {
                    array_push($formFields, [
                        'id' => $value['name'],
                        'label' =>   __('models.' . $value['name']),
                        'type' => 'input',
                        'propierties' => [
                            'type' => 'text',
                            'required' => !$value['nullable']
                        ]
                    ]);

                } elseif ($value['type_name'] === 'date') {
                    array_push($formFields, [
                        'id' => $value['name'],
                        'label' =>   __('models.' . $value['name']),
                        'type' => 'input',
                        'propierties' => [
                            'type' => 'date',
                            'required' => !$value['nullable']
                        ]
                    ]);
                } elseif ($value['type_name'] === 'boolean') {
                    array_push($formFields, [
                        'id' => $value['name'],
                        'label' =>   __('models.' . $value['name']),
                        'type' => 'checkbox',
                        'propierties' => [
                            'required' => !$value['nullable']
                        ]
                    ]);
                }
            }
        }


        return [
            'fields' => $formFields,
            'values'=> $formFieldValues
        ];
    }
}
