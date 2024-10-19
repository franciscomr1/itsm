<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\RequestTypeResource;
use App\Http\Requests\Webapp\RequestTypeRequest;
use App\Models\Webapp\RequestType;
use Inertia\Inertia;

class RequestTypeController extends Controller
{
    public function index()
    {
        $resource = RequestType::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = RequestType::with('issue_type','request_category')->get();
        return RequestTypeResource::collection($resource);
    }

    public function store(RequestTypeRequest $request)
    {
        try {
            $resource = RequestType::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó una nueva Solicitud con ID: '. $resource->id]);
    }

    public function update(RequestTypeRequest $request, $id)
    {
        $resource = RequestType::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó la Solicitud con ID: '. $resource->id]);
    }
    
}
