<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\AssetCategoryResource;
use App\Http\Requests\Webapp\AssetCategoryRequest;
use App\Models\Webapp\AssetCategory;
use Inertia\Inertia;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $resource = AssetCategory::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = AssetCategory::get();
        return AssetCategoryResource::collection($resource);
    }

    public function store(AssetCategoryRequest $request)
    {
        try {
            $resource = AssetCategory::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó una nueva Categoria de Activo con ID: '. $resource->id]);
    }

    public function update(AssetCategoryRequest $request, $id)
    {
        $resource = AssetCategory::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó la Categoria de Activo con ID: '. $resource->id]);
    }
}
