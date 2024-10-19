<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\PriorityLevelResource;
use App\Http\Requests\Webapp\PriorityLevelRequest;
use App\Models\Webapp\PriorityLevel;
use Inertia\Inertia;

class PriorityLevelController extends Controller
{
    public function index()
    {
        $resource = PriorityLevel::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = PriorityLevel::get();
        return PriorityLevelResource::collection($resource);
    }

    public function store(PriorityLevelRequest $request)
    {
        try {
            $resource = PriorityLevel::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Status con ID: '. $resource->id]);
    }

    public function update(PriorityLevelRequest $request, $id)
    {
        $resource = PriorityLevel::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Statusa con ID: '. $resource->id]);
    }
}
