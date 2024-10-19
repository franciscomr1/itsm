<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\RequestCategoryResource;
use App\Http\Requests\Webapp\RequestCategoryRequest;
use App\Models\Webapp\RequestCategory;
use Inertia\Inertia;

class RequestCategoryController extends Controller
{
    public function index()
    {
        $resource = RequestCategory::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = RequestCategory::get();
        return RequestCategoryResource::collection($resource);
    }

    public function store(RequestCategoryRequest $request)
    {
        try {
            $resource = RequestCategory::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Status con ID: '. $resource->id]);
    }

    public function update(RequestCategoryRequest $request, $id)
    {
        $resource = RequestCategory::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Statusa con ID: '. $resource->id]);
    }
}
