<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\IssueTypeResource;
use App\Http\Requests\Webapp\IssueTypeRequest;
use App\Models\Webapp\IssueType;
use Inertia\Inertia;

class IssueTypeController extends Controller
{
    public function index()
    {
        $resource = IssueType::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = IssueType::get();
        return IssueTypeResource::collection($resource);
    }

    public function store(IssueTypeRequest $request)
    {
        try {
            $resource = IssueType::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Tipo de Servicio con ID: '. $resource->id]);
    }

    public function update(IssueTypeRequest $request, $id)
    {
        $resource = IssueType::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Tipo de Servicio con ID: '. $resource->id]);
    }
}
