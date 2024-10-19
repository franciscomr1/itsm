<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\ProviderResource;
use App\Http\Requests\Webapp\ProviderRequest;
use App\Models\Webapp\Provider;
use Inertia\Inertia;

class ProviderController extends Controller
{
    public function index()
    {
        $resource = Provider::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Provider::get();
        return ProviderResource::collection($resource);
    }

    public function store(ProviderRequest $request)
    {
        try {
            $resource = Provider::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Proveedor con ID: '. $resource->id]);
    }

    public function update(ProviderRequest $request, $id)
    {
        $resource = Provider::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Proveedor con ID: '. $resource->id]);
    }
}
