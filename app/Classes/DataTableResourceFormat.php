<?php

namespace App\Classes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class DataTableResourceFormat
{
    private ?string $resourceName = null;

    public function __construct(string $resourceName)
    {
        $this->resourceName = $resourceName;
    }

    public function getResourceAlias(): string
    {
        return __('models.' . $this->resourceName);
    }

    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    public function getAttributes(): array
    {
        $attributesModel =  Schema::getColumnListing($this->resourceName);
        $attributes = [];
        foreach ($attributesModel as $key => $value) {
            $attributes[$key] = ['data' => $value, 'title' =>  __('models.' . $value)];
        }

        if(Route::has($this->resourceName . '.update')){

            array_push($attributes,[
                 "data"=> null,
                  "defaultContent"=> "",
                   'name' => 'update'
            ]);
        }
 
        return $attributes;
    }
}
