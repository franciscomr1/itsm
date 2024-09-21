<?php

namespace App\Classes;
use Illuminate\Support\Facades\Schema;

class DataTableResourceFormat
{
    private ?string $resourceName = null;
    public function __construct(string $resourceName)
    {
        $this->resourceName = $resourceName;
    }

    public function getTitle(): string
    {
        return __('models.' . $this->resourceName);
    }

    public function getRoute(): string
    {
        return "{$this->resourceName}.search";
    }

    public function getColumns(): array
    {
        $columnsModel =  Schema::getColumnListing($this->resourceName);
        $columns = [];
        foreach ($columnsModel as $key => $value) {
            $columns[$key] = ['data' => $value, 'title' =>  __('models.' . $value)];
        }
        return $columns;
    }
}
