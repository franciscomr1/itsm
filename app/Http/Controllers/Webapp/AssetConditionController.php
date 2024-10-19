<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\AssetConditionResource;
use App\Http\Requests\Webapp\AssetConditionRequest;
use App\Models\Webapp\AssetCondition;
use Inertia\Inertia;

class AssetConditionController extends Controller
{
    public function index()
    {
        $resource = AssetCondition::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = AssetCondition::get();
        return AssetConditionResource::collection($resource);
    }

    public function store(AssetConditionRequest $request)
    {
        try {
            $resource = AssetCondition::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó una nueva Condición de Activo con ID: '. $resource->id]);
    }

    public function update(AssetConditionRequest $request, $id)
    {
        $resource = AssetCondition::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó la Condición de Activo con ID: '. $resource->id]);
    }
}
