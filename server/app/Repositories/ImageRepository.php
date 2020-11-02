<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Image ;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class ImageRepository implements ImageInterface
{
    protected $table;
    protected $diskName = 'media';
    protected $relationInstance;


    /**
     * validate
     *
     * @param  mixed $img
     * @return void
     */
    private function validate(Array $img){
        Validator::make( $img,[
            'type'=>['required','string'],
            'name'=>['required','string'],
            'size'=>['required','integer'],
            'lastModified'=>['required','integer'],
             'dataUrl'=>['required','string'],
        ])->validate();

    }

    /**
     * upload
     *
     * @param  mixed $image
     * @return void
     */
    private function upload($image){

        $name = time();
        $extension = $this->nameToExtension($image['name']);
        $file_name = time().'.'.$extension ;

        $content = $image['dataUrl'];

        @list($type, $content) = explode(';', $content);
          @list(, $content)  = explode(',', $content);
        if($content!=""){
               // storing image in storage/app/public Folder
                  Storage::disk($this->diskName)->put( $file_name,base64_decode($content));
    }

    return compact('name','extension','file_name');

    }


    /**
     * nameToExtension
     *return without dot
     * @param  mixed $name
     * @return void
     */
    private function nameToExtension(String $name){
        return Str::of($name)->afterLast('.');
    }




    /**
     * model
     *
     * @param  mixed $image
     * @return ImageRepository
     */
    public function model(Image $image):ImageRepository {
        $this->table = $image;
        return $this;
    }

    /**
     * relation
     *
     * @param  mixed $relation
     * @return ImageRepository
     */
    public function relation(Relation $relation):ImageRepository {
        $this->relationInstance = $relation;
        return $this;
    }
    /**
     * disk
     *
     * @param  mixed $disk
     * @return ImageRepository
     */
    public function disk(String $disk):ImageRepository{
        $this->diskName =$disk;
        return $this;
    }

    /**
     * add
     *imput image Attrebute
     * @param  mixed $image
     * @return Image
     */
    public function add(Array $image,$validate=true):Image{
        if($validate){ $this->validate($image);}

       $upload =  $this->upload($image);

       $name = $upload['name'];
       $file_name= $upload['file_name'];
       $extension = $upload['extension'];
       $disk = $this->diskName;
       $data = compact('name','extension','file_name','disk');

       if($this->relationInstance){
          return $this->relationInstance->create($data);
       }else{
        return Image::create(compact('name','extension','file_name','disk'));
       }


    }

    public function addManny(Array $images):Array{
        foreach ($images as $image) {
            $this->validate($image);
        }

        $self = $this;
      return  array_map(function($image) use($self){
         return $self->add($image,false);
        },$images);
    }


    // public function url(Image $model):String;

    // public function addManny(Array $image):Collection;
}
