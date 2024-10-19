<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\AssetModelResource;
use App\Http\Requests\Webapp\AssetModelRequest;
use App\Models\Webapp\AssetModel;
use Inertia\Inertia;

class AssetModelController extends Controller
{
    public function index()
    {
        $resource = AssetModel::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = AssetModel::with('manufacturer','asset_type')->get();
        return AssetModelResource::collection($resource);
    }

    public function store(AssetModelRequest $request)
    {
        try {
            $resource = AssetModel::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Empleado con ID: '. $resource->id]);
    }

    public function update(AssetModelRequest $request, $id)
    {
        $resource = AssetModel::findOrFail($id);
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
        $resource = AssetModel::where('id',$id)->where('is_active',true)->firstOrFail();
        try {
            $resource->is_active = false; 
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'danger', 'title'=> 'Actualización Exitosa','description'=>'Se inactivó el Empleado con ID: '. $resource->id]);
    }
}
