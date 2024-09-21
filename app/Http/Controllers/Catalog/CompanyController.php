<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\Catalog\CompanyResource;
use App\Classes\DataTableResourceFormat;
use App\Models\Catalog\Company;
class CompanyController extends Controller
{
    public function index()
    {
        $resource = new DataTableResourceFormat('companies');
        return Inertia::render('Custom/Views/Resource', [
            'title' => $resource->getTitle(),
            'route' => $resource->getRoute(),
            'columns' => $resource->getColumns()
        ]);
    }

    public function search(Request $request)
    {
        $resource = Company::get();
        return CompanyResource::collection($resource);
    }
}
