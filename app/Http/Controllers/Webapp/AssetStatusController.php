<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\AssetStatusResource;
use App\Http\Requests\Webapp\AssetStatusRequest;
use App\Models\Webapp\AssetStatus;
use Inertia\Inertia;

class AssetStatusController extends Controller
{
    public function index()
    {
        $resource = AssetStatus::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = AssetStatus::get();
        return AssetStatusResource::collection($resource);
    }

    public function store(AssetStatusRequest $request)
    {
        try {
            $resource = AssetStatus::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Estado de Activo con ID: '. $resource->id]);
    }

    public function update(AssetStatusRequest $request, $id)
    {
        $resource = AssetStatus::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Estado de Activo con ID: '. $resource->id]);
    }
}
