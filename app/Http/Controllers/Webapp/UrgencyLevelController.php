<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\UrgencyLevelResource;
use App\Http\Requests\Webapp\UrgencyLevelRequest;
use App\Models\Webapp\UrgencyLevel;
use Inertia\Inertia;

class UrgencyLevelController extends Controller
{
    public function index()
    {
        $resource = UrgencyLevel::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = UrgencyLevel::get();
        return UrgencyLevelResource::collection($resource);
    }

    public function store(UrgencyLevelRequest $request)
    {
        try {
            $resource = UrgencyLevel::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Nivel de Urgencia con ID: '. $resource->id]);
    }

    public function update(UrgencyLevelRequest $request, $id)
    {
        $resource = UrgencyLevel::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Nivel de Urgencia con ID: '. $resource->id]);
    }
}
