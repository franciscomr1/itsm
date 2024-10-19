<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\ManufacturerResource;
use App\Http\Requests\Webapp\ManufacturerRequest;
use App\Models\Webapp\Manufacturer;
use Inertia\Inertia;

class ManufacturerController extends Controller
{
    public function index()
    {
        $resource = Manufacturer::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Manufacturer::get();
        return ManufacturerResource::collection($resource);
    }

    public function store(ManufacturerRequest $request)
    {
        try {
            $resource = Manufacturer::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Fabricante con ID: '. $resource->id]);
    }

    public function update(ManufacturerRequest $request, $id)
    {
        $resource = Manufacturer::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Fabricante con ID: '. $resource->id]);
    }
}
