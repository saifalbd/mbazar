<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeImage extends Model
{
    use HasFactory;

    protected $fillable = ['url'];
    /**
 * Get the model that the image belongs to.
 */
public function imageable()
{
    return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
}
    
    
}
