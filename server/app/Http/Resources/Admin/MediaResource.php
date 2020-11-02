<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{

    private function imgUrls($urls){
        // return array_map(($item)=>,$urls)

    }
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
            'model_id'=>$this->model_id,
            'model_type'=>$this->model_type,
            'image'=>$this->getUrl(),
            'responsive_images'=>$this->getResponsiveImageUrls(),
        ];
    }
}
