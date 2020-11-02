<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return WarehouseResource::collection(Warehouse::all());
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','string','max:100','unique:warehouses'],
            'place'=>['required','string','max:100'],
            'description'=>['nullable','string','max:1000'],
        ]);



        $data = $request->only(['title','place','description']);
        $warehouse = Warehouse::create($data );
        return response()->json(new WarehouseResource($warehouse),200);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'title'=>['required','string','max:100',Rule::unique('categories')
            ->whereNot('id', $warehouse->id)->where('title', $request->title)],
            'place'=>['required','string','max:100'],
            'description'=>['nullable','string','max:1000'],
        ]);
        $warehouse->title = $request->title;
        $warehouse->place = $request->place;
        $warehouse->description = $request->description;
        $warehouse->save();
        return response()->json(new WarehouseResource($warehouse),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Warehouse $warehouse)
    {
        $warehouse->delete();
        return response('',204);
    }
}
