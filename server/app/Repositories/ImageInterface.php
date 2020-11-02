<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

interface ImageInterface
{

    public function model(Image $model):ImageRepository;
    public function relation(Relation $relation):ImageRepository;
    public function disk(String $disk):ImageRepository;
    // public function url(Image $model):String;
     public function add(Array $image):Image;
    public function addManny(Array $images):Array;


}
