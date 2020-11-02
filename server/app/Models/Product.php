<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Media;
use phpDocumentor\Reflection\Types\Boolean;

class Product  extends Model implements HasMedia
{
    use HasFactory,Media;
    protected $casts = [
        'is_active' => 'boolean',
        'rules' => 'array',

    ];

    protected $fillable = ['title','slug','is_active','description','category_id','rules'];

    public function price(){
        return $this->morphMany(Price::class, 'model');
    }

    public function variants(){
        return $this->morphMany(Price::class, 'model');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'product_cateogry');
    }


    public function images(){
        return $this->morphMany(Image::class, 'imageble');
    }





   /**
     * Get fake image its use for only dami date and devolopment mode.
     */
     public function fakeImage()
     {
         return $this->morphOne(FakeImage::class, 'model');
     }

}
