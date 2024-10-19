<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Ticket extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'subject',
        'description',
        'issue_type_id',
        'request_type_id',
        'request_status_id',
        'urgency_level_id',
        'priority_level_id',
        'request_channel_id',
        'employee_id',
        'assigned_at',
        'escalated_at',
        'closed_at',
    ];

    public function issue_type(): BelongsTo
    {
        return $this->belongsTo(IssueType::class);
    }

    public function request_type(): BelongsTo
    {
        return $this->belongsTo(RequestType::class);
    }

    public function request_status(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class);
    }

    public function priority_level(): BelongsTo
    {
        return $this->belongsTo(PriorityLevel::class);
    }

    public function urgency_level(): BelongsTo
    {
        return $this->belongsTo(UrgencyLevel::class);
    }

    public function request_channel(): BelongsTo
    {
        return $this->belongsTo(RequestChannel::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }


    public function getDatatableColumns(){
        return  [
            'resource'=> 'tickets',
            'title'=> 'Tcikets',
            'columns' => [
                ["data"=>"id","title"=>"ID"],
                ["data"=>"subject","title"=>"Asunto"],
                ["data"=>"description","title"=>"Description"],
                ['data' => 'issue_type_id', 'title' => 'issue_type_id','visible'=> false],
                ['data'=> 'issue_type', 'title'=> __('models.issue_type')],
                ["data"=>"request_type_id","title"=>"request_type",'visible'=> false],
                ['data'=> 'request_type', 'title'=> __('models.request_type')],
                ["data"=>"request_status_id","title"=>"Status ID",'visible'=> false],
                ['data'=> 'request_status', 'title'=> __('models.request_status')],                
                ["data"=>"urgency_level_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'urgency_level', 'title'=> __('models.urgency_level')],                
                ["data"=>"priority_level_id","title"=>"Prioridad ID",'visible'=> false],
                ['data'=> 'priority_level', 'title'=> __('models.priority_level'),'name' => 'priority'],    
                ["data"=>"request_channel_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'request_channel', 'title'=> __('models.request_channel')],                
                ["data"=>"employee_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'employee', 'title'=> 'Empleado'],         
                ["data"=>"assigned_to","title"=>"Asignado a","type"=>"string"],
                ["data"=>"assigned_at","title"=>"Asignado a las","type"=>"string"],
                ["data"=>"escalated_at","title"=>"Escalado a las","type"=>"string"],
                ["data"=>"closed_at","title"=>"Cerrado a las"],
                ["data"=>"created_by","title"=>"Creado Por","type"=>"string"],
                ["data"=>"updated_by","title"=>"Actualizado Por","type"=>"string"],
                ["data"=>"created_at","title"=>"Creado a las","type"=>"date"],
                ["data"=>"updated_at","title"=>"Actualizado a las","type"=>"date"],
                ["data"=>null,"defaultContent"=>"","name"=>"assign"],
                ["data"=> null,"defaultContent"=> "",'name' => 'update']
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
            'request_type_id'=>[
                'related'=> [
                    'data'=> 'request_type', 'title'=> __('models.request_type')
                ],
                'data'=> RequestType::select('id', 'name')->pluck('name', 'id')
            ],
            'request_status_id'=>[
                'related'=> [
                    'data'=> 'request_status', 'title'=> __('models.request_status')
                ],
                'data'=> RequestStatus::select('id', 'name')->pluck('name', 'id')
            ],
            'urgency_level_id'=>[
                'related'=> [
                    'data'=> 'urgency_level', 'title'=> __('models.urgency_level')
                ],
                'data'=> UrgencyLevel::select('id', 'name')->pluck('name', 'id')
            ],
            'priority_level_id'=>[
                'related'=> [
                    'data'=> 'priority_level', 'title'=> __('models.priority_level')
                ],
                'data'=> PriorityLevel::select('id', 'name')->pluck('name', 'id')
            ],
            'request_channel_id'=>[
                'related'=> [
                    'data'=> 'request_channel', 'title'=> __('models.request_channel')
                ],
                'data'=> RequestChannel::select('id', 'name')->pluck('name', 'id')
            ],
            'employee_id'=>[
                'related'=> [
                    'data'=> 'employee', 'title'=> __('models.employee')
                ],
                'data'=> Employee::select('id', 'first_name')->pluck('first_name', 'id')
            ],
        ];
    }
}
