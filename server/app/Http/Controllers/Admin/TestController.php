<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreate;
use App\Models\Product;
use App\Repositories\ImageInterface;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public $image;

    public function __construct( ImageInterface $imageInterface )
    {
        $this->image = $imageInterface;

    }

    public function test(ProductCreate $request){






        return $request->all();

        $product = Product::first();


       $data =  collect($request->data)->map(function($item){
        return   $item['images'][0];
        })->first();

      return  $this->image->relation($product->images())->add($data);

    }
}
