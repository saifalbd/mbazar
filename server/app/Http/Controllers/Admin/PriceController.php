<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PriceResource;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id'=>['required','integer'],
            'regular'=>['required','integer'],
            'special'=>['required','integer'],
            'sku'=>['required','string'],
        ]);

        $product_id = $request->product_id;
        $regular = $request->regular;
        $special = $request->special;
        $sku = $request->sku;
        $data = compact('product_id','regular','special','sku');
        $price = Price::create($data);
        return response()->json(new PriceResource($price),200);
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
    public function update(Request $request, Price $price)
    {

        $request->validate([

            'regular'=>['required','integer'],
            'special'=>['required','integer'],
            'sku'=>['required','integer'],
        ]);

        $price->price = $request->price;
        $price->special_price = $request->special_price;
        $price->sku = $request->sku;
        $price->save();
        return response()->json(new PriceResource($price),200);
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
