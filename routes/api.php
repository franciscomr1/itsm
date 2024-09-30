<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Webapp\Company;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/form/create', function (Request $request) {

    $resourceName = "App\\Models\\Webapp\\" . ucfirst(Str::singular($request->resource));
    $resource = new $resourceName();
    return response()->json($resource::GetFormParamaters($resource->getAttributes()));
})->name('create.resource');
