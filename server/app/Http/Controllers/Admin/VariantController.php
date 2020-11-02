<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VariantResource;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return VariantResource::collection(Variant::all());

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
            'title'=>['required','string','max:100','unique:variants,title'],
            'options'=>['required','array'],
            'options.*'=>['required','string'],
        ]);
        $optipons = collect($request->options)->map(function($item){
            return ['title'=>$item];
        })->toArray();


        $title = $request->title;

        $variant =   Variant::create(compact('title'));
        $variant->options()->createMany($optipons );


        return response()->json(new VariantResource($variant),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'title'=>['required','string','max:100',Rule::unique('categories')
            ->whereNot('id', $variant->id)->where('title', $request->title)],

        ]);

        $title = $request->title;
      $variant->title = $title;

        return response()->json($variant,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();
        return response('',204);
    }
}
