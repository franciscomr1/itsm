<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\AssetTypeResource;
use App\Http\Requests\Webapp\AssetTypeRequest;
use App\Models\Webapp\AssetType;
use Inertia\Inertia;

class AssetTypeController extends Controller
{
    public function index()
    {
        $resource = AssetType::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = AssetType::with('asset_category')->get();
        return AssetTypeResource::collection($resource);
    }

    public function store(AssetTypeRequest $request)
    {
        try {
            $resource = AssetType::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Tipo de Activo con ID: '. $resource->id]);
    }

    public function update(AssetTypeRequest $request, $id)
    {
        $resource = AssetType::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Tipo de Activo con ID: '. $resource->id]);
    }
}
