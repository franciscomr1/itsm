<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Webapp\GetResourceObject;
use App\Traits\Webapp\GetResourceFormFields;
use App\Traits\Database\AddFieldsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DateTimeInterface;

class Employee extends Model
{
    use HasFactory, GetResourceObject, GetResourceFormFields ,  AddFieldsCreatedByAndUpdatedBy;

    protected $fillable = [
        'branch_id',
        'position_id',
        'first_name',
        'last_name',
        'employee_id_number',
        'hire_date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getDatatableColumns(){
        return  [
            'resource'=> 'employees',
            'title'=> 'Empleados',
            'columns' => [
                ["data"=>"id","title"=>"ID"],
                ['data' => 'branch_id', 'title' => 'branch_id','visible'=> false],
                ['data'=> 'branch', 'title'=> __('models.branch')],
                ["data"=>"position_id","title"=>"Puesto ID",'visible'=> false],
                ['data'=> 'position', 'title'=> __('models.position')],
                ["data"=>"first_name","title"=>"Nombre","type"=>"string"],
                ["data"=>"last_name","title"=>"Apellidos","type"=>"string"],
                ["data"=>"employee_id_number","title"=>"ID de Empleado"],
                ["data"=>"hire_date","title"=>"Fecha de Ingreso"],
                ["data"=>null, "title"=>"Activo", 'name' => 'active'],
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
            'branch_id'=>[
                'related'=> [
                    'data'=> 'branch', 'title'=> __('models.branch')
                ],
                'data'=> Branch::select('id', 'name')->pluck('name', 'id')
            ],
            'position_id'=>[
                'related'=> [
                    'data'=> 'position', 'title'=> __('models.position')
                ],
                'data'=> Position::select('id', 'name')->pluck('name', 'id')
            ]
        ];
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
