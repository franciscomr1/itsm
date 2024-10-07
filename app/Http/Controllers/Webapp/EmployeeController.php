<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\EmployeeResource;
use App\Http\Requests\Webapp\EmployeeRequest;
use App\Models\Webapp\Employee;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $resource = Employee::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Employee::with('branch','position')->get();
        return EmployeeResource::collection($resource);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $resource = Employee::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Empleado con ID: '. $resource->id]);
    }

    public function update(EmployeeRequest $request, $id)
    {
        $resource = Employee::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Empleado con ID: '. $resource->id]);
    }
    
    public function deactivate($id)
    {
        $resource = Employee::where('id',$id)->where('is_active',true)->firstOrFail();
        try {
            $resource->is_active = false; 
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'danger', 'title'=> 'Actualización Exitosa','description'=>'Se inactivó el Empleado con ID: '. $resource->id]);
    }
}
