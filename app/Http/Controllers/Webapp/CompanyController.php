<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Webapp\CompanyResource;
use App\Classes\DataTableResourceFormat;
use App\Http\Requests\Webapp\CompanyRequest;
use App\Models\Webapp\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $resource = new DataTableResourceFormat('companies');
        return Inertia::render('Custom/Views/Resource', [
            'title' => $resource->getResourceAlias(),
            'resource' => $resource->getResourceName(),
            'columns' => $resource->getAttributes()
        ]);
    }

    public function search(Request $request)
    {
        $resource = Company::get();
        return CompanyResource::collection($resource);
    }

    public function store(CompanyRequest $request)
    {
        try {
            $resource = new Company();
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo recurso con ID: '. $resource->id]);
    }

    public function update(CompanyRequest $request, $id)
    {
        try {
            $resource = Company::findOrFail($id);
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el recurso con ID: '. $resource->id]);
    }

    public function show($id){
        $model = Company::findOrFail($id);
        return response()->json( CompanyResource::make($model));
    }
}
