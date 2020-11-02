<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use HasFactory,Media;
    protected $fillable = ['title','slug','is_active','description'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

     /**
     * Get fake image its use for only dami date and devolopment mode.
     */
     public function fakeImage()
     {
         return $this->morphOne(FakeImage::class, 'model');
     }
}
