<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        // $request->validate([
        //     'user_id'=>['required','integer','exists:App\Models\User,id'],
        // ]);
        $carts = Cart::query()->where('user_id',$user_id)->get();
        return CartResource::collection($carts);
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
            'qty'=>['required','integer'],
            'product_id'=>['required','integer','exists:App\Models\Product,id'],

        ]);

        $qty = $request->qty;
        $product_id = $request->product_id;
        $user_id = $request->user()->id;

        $cart = Cart::create(compact('qty','product_id','user_id'));

        return response()->json(new CartResource($cart),200);



    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cart $cart)
    {
        $request->validate([
            'qty'=>['required','integer'],


        ]);

        $qty = $request->qty;

        $cart->qty = $qty;

        $cart->save();

        return new CartResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response('',204);
    }
}
