<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductResource extends JsonResource
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
            "id"=>$this->id,
            "local_id"=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,  
            'image'=>$this->thumb?$this->thumb:$this->fakeImage->url,
            'media'=>MediaResource::collection($this->media),
            'category_id'=>$this->category_id,
            'category'=>new CategoryResource($this->category),
            'hasPrice'=>$this->price?true:false,
            'badgeLabel'=>'5% OFF',
            'price'=>new PriceResource($this->price),
            'isActive'=>$this->is_active,
            'ratingScore'=>rand(1,5),
            'isOnWishlist'=> Arr::random([false,true]),
            'isOnCartlist'=> Arr::random([false,true]),
            'rules'=>$this->rules,
            'reviewsCount'=>rand(5,300),
            'createOn'=>$this->created_at->diffForHumans(),
            'updateOn'=>$this->updated_at->diffForHumans(),
            'description'=>$this->description,

        ];
    }
}
