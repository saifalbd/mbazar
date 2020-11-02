<?php

namespace Database\Seeders;

use Database\DataCollection\ProductCollection;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{

   
    public static function image($model, string $url){
        $model->fakeImage()->create(['url'=>$url]);
    }
    public static function model($model)
    {
        $title = $model['category'];
        $description =  $model['description'];
        $is_active = true;
       
        $slug = Str::slug($model['category']);
        return compact('title','description','slug','is_active');
    }

    public function collection()
    {
        return collect(ProductCollection::collection())->map(function($item){
           $brand =  Brand::create(static::model($item));
           static::image($brand,$item['image']);
           return $brand;
           
        });
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->collection();
        
    }
}
