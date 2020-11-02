<?php

namespace App\Traits;
use Spatie\MediaLibrary\InteractsWithMedia;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

//php artisan make:trait MyTrait
//command
trait Media
{
    use InteractsWithMedia;

    public static function dummyImgPath ($rand,$path){
        $stores =  Storage::disk('test');

        return Arr::random($stores ->files($path) ,$rand);
      // return  $stores ->url(Arr::random($files ));
    }

public function generateDummyImages($path,$collection  = false ){


  $files  =  static::dummyImgPath($collection?5:1,$path);

    $this->addMediaFromDisk(   $files[0] , 'test')
    ->toMediaCollection('thumbnail');
    if ($collection) {
        Collection::times(4)->each(function($key)  use($files) {

            $file  = $files[$key];
            $this->addMediaFromDisk(   $file , 'test')->toMediaCollection('collection');
        });
    }


}
public function addImgCollection($files){
    foreach ($files as $value){
        $this-> addMedia($value)
        ->toMediaCollection('collection');
    }
    return $this;
}
public function addThumb($file){
    $this ->addMedia($file)
    ->withResponsiveImages()
    ->toMediaCollection('thumbnail') ;
    return $this;
}

public function replaceThumb($file){
    $this->media()->delete();
    $this ->addMedia($file)
    ->toMediaCollection('thumbnail') ;
    return $this;
}
  public function getImageCollectionAttribute(){

      $medias = $this ->getMedia('collection')->map(function($item){
          return $item ->getUrl();
      });
      return $medias;


  }
  public function getThumbAttribute(){
      return $this ->getFirstMediaUrl('thumbnail');

  }

    /*
     * Get the url of the image for the given conversionName
     * for first media for the given collectionName.
     * If no profile is given, return the source's url.
     */
    // public function getFirstMediaUrl( ): string
    // {
    //     $media = $this->getFirstMedia('thumbnail');

    //     if (!$media) {
    //         return $this->getFallbackMediaUrl('thumbnail') ?: '';
    //     }

    //     return $media->getUrl('thumbnail');
    // }
}
