<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VariantOptionController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $variants =  VariantOption::all();
       return response()->json(['data'=>$variants ],200);
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
            'title'=>['required','string','max:100',
            'unique:variant_options,title'],

        ]);

        $title = $request->title;
      $variant =   VariantOption::create(compact('title'));
        return response()->json($variant,200);

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
    public function update(Request $request, VariantOption $variant)
    {
        $request->validate([
            'title'=>['required','string','max:100',
            Rule::unique('variant_options')
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
    public function destroy(VariantOption $variant)
    {
        $variant->delete();
        return response('',204);
    }
}
