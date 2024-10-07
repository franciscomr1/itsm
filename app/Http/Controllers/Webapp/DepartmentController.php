<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\DepartmentResource;
use App\Http\Requests\Webapp\DepartmentRequest;
use App\Models\Webapp\Department;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $resource = Department::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Department::get();
        return DepartmentResource::collection($resource);
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $resource = Department::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Departamento con ID: '. $resource->id]);
    }

    public function update(DepartmentRequest $request, $id)
    {
        $resource = Department::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Departamento con ID: '. $resource->id]);
    }

}
