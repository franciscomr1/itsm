<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes\DataTableResourceFormat;
use App\Http\Resources\Webapp\RequestChannelResource;
use App\Http\Requests\Webapp\RequestChannelRequest;
use App\Models\Webapp\RequestChannel;
use Inertia\Inertia;

class RequestChannelController extends Controller
{
    public function index()
    {
        $resource = RequestChannel::GetResourceObject();
        return Inertia::render('Custom/Views/Resource', $resource);
    }

    public function search(Request $request)
    {
        $resource = RequestChannel::get();
        return RequestChannelResource::collection($resource);
    }

    public function store(RequestChannelRequest $request)
    {
        try {
            $resource = RequestChannel::create($request->validated());
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'success', 'title'=> 'Alta Exitosa','description'=>'Se creó un nuevo Status con ID: '. $resource->id]);
    }

    public function update(RequestChannelRequest $request, $id)
    {
        $resource = RequestChannel::findOrFail($id);
        try {
            $resource->fill($request->validated());
            $resource->save();
        } catch (Exception $e) {
            $e->getMessage();
        }

        return back()->with('message',['type'=>'info', 'title'=> 'Actualización Exitosa','description'=>'Se actualizó el Statusa con ID: '. $resource->id]);
    }
}
