<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\PositionResource;
use App\Http\Requests\Webapp\PositionRequest;
use App\Models\Webapp\Position;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function index()
    {
        $resource = Position::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Position::with('department')->get();
        return PositionResource::collection($resource);
    }

    public function store(PositionRequest $request)
    {
        try {
            $resource = Position::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Empleado con ID: '. $resource->id]);
    }

    public function update(PositionRequest $request, $id)
    {
        $resource = Position::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Empleado con ID: '. $resource->id]);
    }
}
