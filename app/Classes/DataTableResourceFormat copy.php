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

    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    public function getColumns(): array
    {
        $columnsModel =  Schema::getColumnListing($this->resourceName);
        $columns = [];
        foreach ($columnsModel as $key => $value) {
            $columns[$key] = ['data' => $value, 'title' =>  __('models.' . $value)];
        }

        array_push($columns,[
             "data"=> null,
              "defaultContent"=> "",
               'name' => 'update'
        ]);

    /* 
    

            array_push($columns, 
        [
            'data'=> null,
            'title'=>'actions',
            'orderable'=> false,
            'searchable'=>false,
            'type'=> 'html',
            'render'=>'#update',
        ]    );
 



    array_push($columns, 
    [
        'data'=> null,
        'name'=>'update',
      'render'=> 'update',
        'title'=> 'update'
    ]    );
    */

        
        return $columns;
    }
}
