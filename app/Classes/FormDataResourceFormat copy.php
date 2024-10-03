<?php

namespace App\Classes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class FormDataResourceFormat
{
    private ?Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getTitle(): string
    {
        return __('models.' . $this->model->getTable());
    }

    public function getResourceName(): string
    {
        return $this->model->getTable();
    }

    public function getFormPropierties()
    {
        $columnsModel =  Schema::getColumns($this->model->getTable());
        $includeColumns = $this->model->getFillable();
        $columns = [];

        foreach ($columnsModel as $key => $value) {
            if ($value['type_name'] === 'varchar' && in_array($value['name'], $includeColumns)) {
                $includeColumns = array_diff($includeColumns, array($value['name']));
                $columns[$key] = [
                    'id' => $value['name'],
                    'label' =>  __('models.' . $value['name']),
                    'type' => 'input',
                    'propieties' => [
                        'type' => 'text',
                        'required' => !$value['nullable']

                    ]
                ];
            }
        }

        return $columns;
    }
}
