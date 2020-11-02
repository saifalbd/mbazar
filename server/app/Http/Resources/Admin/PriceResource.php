<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
           'id'=> $this->id,
        'product_id'=> $this->product_id,
        'regular'=> '$'.$this->regular,
        'special'=> '$'.$this->special,
        'sku'=>$this->sku,
        ];
    }
}
