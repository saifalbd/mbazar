<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory,Media;
    protected $fillable = ['title','slug','is_active','description','parent_id'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
 * Get the route key for the model.
 *
 * @return string
 */
public function getRouteKeyName()
{
    return 'slug';
}

    public function products(){
        return $this->belongsToMany(Product::class, 'product_cateogry');
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }
    public function childrens(){
        return $this->hasMany(self::class,'parent_id');
    }

        /**
     * Get fake image its use for only dami date and devolopment mode.
     */
     public function fakeImage()
     {
         return $this->morphOne(FakeImage::class, 'model');
     }
}
