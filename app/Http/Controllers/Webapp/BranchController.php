<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\BranchResource;
use App\Http\Requests\Webapp\BranchRequest;
use App\Models\Webapp\Branch;
use Inertia\Inertia;

class BranchController extends Controller
{
    public function index()
    {
        $resource = Branch::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Branch::with('company')->get();
        return BranchResource::collection($resource);
    }

    public function store(BranchRequest $request)
    {
        try {
            $resource = Branch::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó una nueva Sucursal con ID: '. $resource->id]);
    }

    public function update(BranchRequest $request, $id)
    {
        $resource = Branch::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó la Sucursal con ID: '. $resource->id]);
    }
}
