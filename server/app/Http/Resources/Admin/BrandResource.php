<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->thumb?$this->thumb:$this->fakeImage->url,
            'isActive'=>$this->is_active,
            'createOn'=>$this->created_at->diffForHumans(),
            'updateOn'=>$this->updated_at->diffForHumans(),
            'description'=>$this->description,

        ];
    }
}
