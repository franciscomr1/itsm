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
            'title' => $resource->getTitle(),
            'resource' => $resource->getResourceName(),
            'columns' => $resource->getColumns()
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
}
