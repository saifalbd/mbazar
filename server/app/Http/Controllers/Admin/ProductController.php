<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductCollection;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->paginate();
        return new ProductCollection($products);
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
            'title'=>['required','string','max:100','unique:products'],
            'category_id'=>['required','integer'],
            'brand_id'=>['sometimes','integer'],
            'description'=>['sometimes','string','max:1000'],
            'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2000'
        ]);

        $rules = ['isFeatured'=>true,'isFavorite'=>true,'isBest'=>true,'isTopSale'=>true];



        $title = $request->title;
        $slug = Str::slug($title);
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;
        $description = $request->description;
        $images = $request->images;

        $product = Product::create(compact('rules','title','slug','category_id','brand_id','description'));

        foreach ( $images as $key => $image) {
            $product->addThumb($image);
        }


        return response()->json(new ProductResource($product),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product),200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $request->validate([
            'title'=>['required','string','max:100',Rule::unique('categories')
            ->whereNot('id', $product->id)->where('title', $request->title)],
            'category_id'=>['required','integer'],
            'brand_id'=>['sometimes','integer'],
            'active'=>['required','in:0,1'],
            'description'=>['sometimes','string','max:1000'],
            'image'=>['sometimes','required','image'],
        ]);


        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        if ($request->active && !$product->price) {
            return response()->json([
                'message'=>'The given data was invalid.',
                'errors'=>[
                    'active'=>['before add product prices then active product']
                    ]
            ],422);
        }
        $product->is_active = $request->active;
        $product->save();

        // $image = $request->file('image');

        // if ($image) {
        //     $product->replaceThumb($image);
        // }

        return response()->json(new ProductResource($product),200);

    }

    public function ruleUpdate(Request $request,Product $product){


        $request->validate([
            'rule'=>['required','in:isFeatured,isFavorite,isBest,isTopSale'],
            'value'=>['required','in:1,0']
        ]);


        $rules = collect($product->rules)
        ->replace([$request->rule=>$request->value?true:false])->toArray();

        $product->rules = $rules;

        $product->save();


        return response()->json(new ProductResource($product),200);





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
