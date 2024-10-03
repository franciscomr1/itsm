<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Classes\DataTableResourceFormat;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Webapp\Department;
use App\Http\Requests\Webapp\DepartmentRequest;
use App\Http\Resources\Webapp\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        $resource = new DataTableResourceFormat('departments');
        return Inertia::render('Custom/Views/Resource', [
            'title' => $resource->getResourceAlias(),
            'resource' => $resource->getResourceName(),
            'columns' => $resource->getAttributes()
        ]);
    }

    public function search(Request $request)
    {
        $resource = Department::get();
        return DepartmentResource::collection($resource);
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $resource = new Department();
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo recurso con ID: '. $resource->id]);
    }

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $resource = Department::findOrFail($id);
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el recurso con ID: '. $resource->id]);
    }

    public function show($id){
        $model = Department::findOrFail($id);
        return response()->json( DepartmentResource::make($model));
    }
}
