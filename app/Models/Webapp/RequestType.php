<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class RequestType extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'issue_type_id',
        'request_category_id',
        'name',
    ];

    public function issue_type(): BelongsTo
    {
        return $this->belongsTo(IssueType::class);
    }

    public function request_category(): BelongsTo
    {
        return $this->belongsTo(RequestCategory::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getDatatableColumns(){
        return  [
            'resource'=> 'request_types',
            'title'=> 'Tipos de Incidentes',
            'columns' => [
                ["data"=>"id","title"=>"ID"],
                ['data' => 'issue_type_id', 'title' => 'issue_type_id','visible'=> false],
                ['data'=> 'issue_type', 'title'=> __('models.issue_type')],
                ["data"=>"request_category_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'request_category', 'title'=> __('models.request_category')],
                ["data"=>"name","title"=>"Nombre","type"=>"string"],
                ["data"=>"created_by","title"=>"Creado Por","type"=>"string"],
                ["data"=>"updated_by","title"=>"Actualizado Por","type"=>"string"],
                ["data"=>"created_at","title"=>"Creado a las","type"=>"date"],
                ["data"=>"updated_at","title"=>"Actualizado a las","type"=>"date"],
                ["data"=>null,"defaultContent"=>"","name"=>"update"],
                ["data"=> null,"defaultContent"=> "",'name' => 'deactivate']
            ]
        ];
    }

    public function getRelationships(): array
    {
        return [
            'issue_type_id'=>[
                'related'=> [
                    'data'=> 'issue_type', 'title'=> __('models.issue_type')
                ],
                'data'=> IssueType::select('id', 'name')->pluck('name', 'id')
            ],
            'request_category_id'=>[
                'related'=> [
                    'data'=> 'request_category', 'title'=> __('models.request_category_id')
                ],
                'data'=> RequestCategory::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }

}
