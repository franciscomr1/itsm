<?php

namespace App\Traits\Webapp;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

trait GetResourceObject
{
    public function scopeGetResourceObject(Builder $builder) {
        $tableAttributes =  Schema::getColumns(self::getTable());
        $modelFillable = self::getFillable();
        $attributes = [];
        $formData = [];
        foreach ($tableAttributes as $key => $value) {
            $relationshipColumn = null;
            $relationshipForm = null;

            if (method_exists($this, 'getRelationships')) {
                foreach (self::getRelationships() as $relationshipkey => $relationshipValue) {
                    if($value['name'] === $relationshipkey) {
                        $relationshipColumn = [
                            'data' => $value['name'], 
                            'title' =>  __('models.' . $value['name']), 
                            'visible'=> false
                        ];
                        array_push($attributes, $relationshipColumn);
                        array_push($attributes, $relationshipValue['related']); 
                    } 
                } 
            } 
            if($relationshipColumn===null){
                $var = $value['name'];
                if ($value['type_name'] === 'varchar') {
                    array_push($attributes, [
                        'data' => $value['name'],
                        'title' =>  __('models.' . $value['name']),
                        'type'=> 'string'
                    ]);
                } elseif ($value['type_name'] === 'datetime') {
                    array_push($attributes, [
                        'data' => $value['name'],
                         'title' =>  __('models.' . $value['name']),
                         'type'=> 'date'
                    ]);
                }elseif ($value['type_name'] === 'tinyint') {
                    array_push($attributes, [
                        'data' => $value['name'],
                         'title' =>  __('models.' . $value['name']),
                         'type'=> 'num', 'className'=> 'dt-type-boolean'
                        ]);
                }else {
                    array_push($attributes, [
                        'data' => $value['name'],
                         'title' =>  __('models.' . $value['name'])
                    ]);
                }
            }   
        }

        if(Route::has(self::getTable() . '.update')){
            array_push($attributes,[
                 "data"=> null,
                  "defaultContent"=> "",
                   'name' => 'update'
            ]);
        }

        if(Route::has(self::getTable() . '.deactivate')){
            array_push($attributes,[
                 "data"=> null,
                  "defaultContent"=> "",
                   'name' => 'deactivate'
            ]);
        }

        

        return [
            'resource' => self::getTable(),
            'title' => __('models.' . self::getTable()),
            'columns' => $attributes,
        ];

    }
}
