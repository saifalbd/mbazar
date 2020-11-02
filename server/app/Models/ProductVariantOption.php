<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
    use HasFactory;

    public function price(){
        return $this->morphMany(Price::class, 'model');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageble');
    }
}
