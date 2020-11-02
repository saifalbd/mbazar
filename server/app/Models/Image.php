<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $appends = ['url'];


    protected $fillable = ['name','file_name','extension','disk','path'];





    /**
     * getUrlAttribute
     *
     * @return String
     */
    public function getUrlAttribute() : String
    {
        return Storage::disk($this->disk)->url($this->file_name);

    }





}
