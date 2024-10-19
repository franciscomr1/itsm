<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\TicketResource;
use App\Http\Requests\Webapp\TicketRequest;
use App\Models\Webapp\UrgencyLevel;
use App\Models\Webapp\Ticket;
use App\Models\Webapp\RequestType;
use Inertia\Inertia;
use Illuminate\Support\Carbon;  
use Illuminate\Support\Collection;

class TicketController extends Controller
{
    public function index()
    {
        $resource = Ticket::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function create()
    {

        $data = RequestType::select('id', 'name')->pluck('name', 'id');
        $urgency = UrgencyLevel::select('id', 'name')->pluck('name', 'id');
        return Inertia::render('Custom/Views/CreateTicket',
    [
        'title'=>'Crear Ticket',
        'resource'=>'tickets',
        'fields'=>[
            ['id'=>'request_type_id','label'=>'Tipo de Solicitud','type'=>'select','propierties'=>[
                'required'=>true,
                'data'=>$data
            ]],
            ['id'=>'subject','label'=>'Asunto','type'=>'input','propierties'=>[
                'required'=>true
            ]],
            ['id'=>'description','label'=>'Descripcion','type'=>'input','propierties'=>[
                'required'=>true
            ]],
            ['id'=>'urgency_level_id','label'=>'Urgencia','type'=>'select','propierties'=>[
                'required'=>true,
                'data'=>$urgency
            ]],

        ],
        'values'=>[
            'subject'=>null,
            'description'=> null,
            'request_type_id'=>null,
            'urgency_level_id'=> null
        ]
    ]);
    }

    public function search(Request $request)
    {
        $resource = Ticket::with('issue_type','request_type','request_status','urgency_level','priority_level','request_channel','employee')->get();
        return TicketResource::collection($resource);
    }

    public function store(TicketRequest $request)
    {
        $request_type = RequestType::find($request->get('request_type_id'));
        $array_data = [
            'issue_type_id' => $request_type->issue_type_id,
            'request_category_id'=> $request_type->request_category_id,
            'request_status_id'=>1,
            'employee_id'=>Auth::user()->employee_id,
            'priority_level_id'=>1,
            'request_channel_id'=>1

        ];

        $resource = New Ticket();
        try {
            $resource->fill($request->validated());
            $resource->fill($array_data);
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Empleado con ID: '. $resource->id]);
    }

    public function update(TicketRequest $request, $id)
    {
        $resource = Ticket::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Empleado con ID: '. $resource->id]);
    }

    public function assign($id) {

        $resource = Ticket::where('id',$id)->where('assigned_to',null)->firstOrFail();

        //$resource = Ticket::findOrFail($id);

        $resource->assigned_to = Auth::user()->employee->getFullNameAttribute(); 
        $resource->assigned_at =now();
        $resource->save();

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Ticket con ID: '. $resource->id]);
    }

    public function chart() {



        $issueTypeCounts = Ticket::select('issue_type_id')
            ->with('issue_type:id,name')
            ->get()
            ->groupBy('issue_type.name')
            ->map(function ($group) {
   
                return $group->count();
            });


            $priorityTypeCounts = Ticket::select('priority_level_id')
            ->with('priority_level:id,name')
            ->get()
            ->groupBy('priority_level.name')
            ->map(function ($group) {
   
                return $group->count();
            });

            $userCounts = Ticket::select('assigned_to')
            ->get()
            ->groupBy('assigned_to')
            ->map(function ($group) {
   
                return $group->count();
            });


        return Inertia::render('Custom/Views/ChartTicket',
            [
                'chartDataIssue' => [
                    'labels'=>$issueTypeCounts->keys()->all(),
                    'datasets' => [
                        ['data' => $issueTypeCounts->values(),'label'=>'Tickets levantados por tipo de caso', 'backgroundColor'=> ['#1a5fb4', '#26a269','#e5a50a','#c64600','#a51d2d', '#613583','#63452c']],

                    ]
                ],
                'chartDataPriority' => [
                    'labels'=>$priorityTypeCounts->keys()->all(),
                    'datasets' => [
                        ['data' => $priorityTypeCounts->values(),'label'=>'Tickets levantados por Prioridad', 'backgroundColor'=> ['#1a5fb4', '#26a269','#e5a50a','#c64600','#a51d2d', '#613583','#63452c']],

                    ]
                ],

                'chartDataUser' => [
                    'labels'=>$userCounts->keys()->all(),
                    'datasets' => [
                        ['data' => $userCounts->values(),'label'=>'Tickets levantados por Agente', 'backgroundColor'=> ['#1a5fb4', '#26a269','#e5a50a','#c64600','#a51d2d', '#613583','#63452c']],

                    ]
                ],

            ]);

    }

}
