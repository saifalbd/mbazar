<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
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
            'place'=>$this->place,
            'createOn'=>$this->created_at->diffForHumans(),
            'updateOn'=>$this->updated_at->diffForHumans(),


        ];
    }
}
