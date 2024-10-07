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
        $resource = Company::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Company::get();
        return CompanyResource::collection($resource);
    }

    public function store(CompanyRequest $request)
    {
        try {
            $resource = Company::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó una nueva Empresa con ID: '. $resource->id]);
    }

    public function update(CompanyRequest $request, $id)
    {
        $resource = Company::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó la Empresa con ID: '. $resource->id]);
    }

    public function show($id){
        $model = Company::findOrFail($id);
        return response()->json( CompanyResource::make($model));
    }
}
