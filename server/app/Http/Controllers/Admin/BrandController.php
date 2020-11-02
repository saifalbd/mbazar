<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::query()->paginate();
        return BrandResource::collection($brands);
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
            'title'=>['required','string','max:100','unique:brands'],
            'image'=>['required','image'],
            'description'=>['required','string','max:1000'],
        ]);
        $title = $request->title;
        $slug = Str::slug($title);
        $description = $request->description;
        $image = $request->file('image');
        $brand = Brand::create(compact('title','slug','description'));

        $brand->addThumb($image);

        return response()->json(new BrandResource($brand),200);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {

        $request->validate([
            'title'=>['required','string','max:100',Rule::unique('brands')
            ->whereNot('id', $brand->id)->where('title', $request->title)],
            'active'=>['required','in:0,1'],
            'description'=>['sometimes','string','max:1000'],
            'image'=>['sometimes','required','image'],
        ]);


        $brand->title = $request->title;
        $brand->is_active = $request->active;
        $brand->description = $request->description;
        $brand->save();

        $image = $request->file('image');

        if ($image) {
            $brand->replaceThumb($image);
        }

        return response()->json(new BrandResource($brand),200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response('',204);
    }
}
