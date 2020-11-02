<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    protected $with = ['options'];

    public function options(){
        return $this->morphMany(VariantOption::class, 'model');
    }

}
