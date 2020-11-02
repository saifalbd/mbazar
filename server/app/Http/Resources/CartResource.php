<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\PriceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'qty'=>$this->qty,
            'product_id'=>$this->product_id,
            'title'=>$this->title,
            'image'=>$this->product->thumb?$this->product->thumb:$this->product->fakeImage->url,
            'category_id'=>$this->product->category_id,
            'price'=>new PriceResource($this->product->price),
            'configuration'=>array (
                0 =>
                array (
                  'name' => 'Size',
                  'value' => 'XS',
                ),
                1 =>
                array (
                  'name' => 'Color',
                  'value' => 'White',
                ),
              )

        ];
    }
}
