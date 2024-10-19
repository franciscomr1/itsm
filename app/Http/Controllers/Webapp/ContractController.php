<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\ContractResource;
use App\Http\Requests\Webapp\ContractRequest;
use App\Models\Webapp\Contract;
use Inertia\Inertia;

class ContractController extends Controller
{
    public function index()
    {
       $resource = Contract::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = Contract::with('provider')->get();
        return ContractResource::collection($resource);
    }

    public function store(ContractRequest $request)
    {
        try {
            $resource = Contract::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Contrato con ID: '. $resource->id]);
    }

    public function update(ContractRequest $request, $id)
    {
        $resource = Contract::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Contrato con ID: '. $resource->id]);
    }
}
