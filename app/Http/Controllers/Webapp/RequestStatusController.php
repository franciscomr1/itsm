<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\RequestStatusResource;
use App\Http\Requests\Webapp\RequestStatusRequest;
use App\Models\Webapp\RequestStatus;
use Inertia\Inertia;

class RequestStatusController extends Controller
{
    public function index()
    {
        $resource = RequestStatus::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = RequestStatus::get();
        return RequestStatusResource::collection($resource);
    }

    public function store(RequestStatusRequest $request)
    {
        try {
            $resource = RequestStatus::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Status con ID: '. $resource->id]);
    }

    public function update(RequestStatusRequest $request, $id)
    {
        $resource = RequestStatus::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Statusa con ID: '. $resource->id]);
    }
}
